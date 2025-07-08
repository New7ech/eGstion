<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Article; // Product model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB; // Pour les transactions
use Illuminate\Support\Facades\Validator;


class CheckoutController extends Controller
{
    /**
     * Affiche la page de checkout (formulaire client, récap panier, etc.).
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('home')->with('info', 'Votre panier est vide.');
        }

        $total = $this->calculateCartTotal($cart);
        // Vous pouvez ici ajouter la logique pour les frais de port, taxes, etc.
        // Pour l'instant, le total est le sous-total des produits.

        // Enrichir les items du panier avec les détails des produits si nécessaire
        $productIds = array_keys($cart);
        $productsDetails = Article::whereIn('id', $productIds)->get()->keyBy('id');
        $cartItems = [];
        foreach ($cart as $id => $item) {
            if (isset($productsDetails[$id])) {
                $cartItems[] = [
                    'id' => $id,
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'image_url' => $productsDetails[$id]->image_url,
                    'slug' => $productsDetails[$id]->slug,
                ];
            }
        }


        return view('ecommerce.checkout', compact('cartItems', 'total'));
    }

    /**
     * Traite la commande.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process(Request $request)
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('home')->with('info', 'Votre panier est vide.');
        }

        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
            'shipping_address_line1' => 'required|string|max:255',
            'shipping_address_city' => 'required|string|max:100',
            'shipping_address_postal_code' => 'required|string|max:20',
            'shipping_address_country' => 'required|string|max:100', // Peut-être un select ou une valeur par défaut
            // Ajouter d'autres validations si nécessaire (mode de livraison, etc.)
        ]);

        if ($validator->fails()) {
            return redirect()->route('checkout.index')
                        ->withErrors($validator)
                        ->withInput();
        }

        DB::beginTransaction();

        try {
            $subtotalAmount = $this->calculateCartTotal($cart);
            $shippingCost = 5.00; // Exemple de frais de port fixes, à rendre dynamique si besoin
            $totalAmount = $subtotalAmount + $shippingCost;

            // Construction de l'adresse de livraison
            // Il serait préférable de stocker l'adresse de manière plus structurée (ex: JSON ou table dédiée)
            // Pour cet exemple, on concatène dans un champ texte, mais ce n'est pas idéal pour une utilisation future.
            // La migration Order a été définie avec `shipping_address` en tant que `text`.
            // Si vous voulez stocker en JSON, assurez-vous que le cast est correct dans le modèle Order.
            $shippingAddress = [
                'line1' => $request->shipping_address_line1,
                'line2' => $request->shipping_address_line2, // Optionnel
                'city' => $request->shipping_address_city,
                'postal_code' => $request->shipping_address_postal_code,
                'country' => $request->shipping_address_country,
                'state' => $request->shipping_address_state, // Optionnel
            ];


            $order = Order::create([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'shipping_address' => json_encode($shippingAddress), // Stocker en JSON
                // 'billing_address' => json_encode($billingAddress), // Si applicable
                'total_amount' => $totalAmount,
                'subtotal_amount' => $subtotalAmount,
                // 'tax_amount' => $calculatedTax, // Si applicable (TVA par exemple)
                'shipping_cost' => $shippingCost,
                'status' => 'pending', // Ou 'processing' si le paiement est immédiat
                'payment_method' => $request->input('payment_method', 'cash_on_delivery'), // Paiement à la livraison par défaut
                'payment_status' => 'pending',
                // 'shipping_method' => $request->shipping_method, // Si applicable
                'notes' => $request->notes,
            ]);

            foreach ($cart as $productId => $item) {
                $product = Article::find($productId);
                if (!$product) {
                    // Ce cas ne devrait pas arriver si le panier est bien géré
                    throw new \Exception("Produit avec ID {$productId} non trouvé.");
                }

                // Vérification du stock avant de créer l'OrderItem
                if ($product->quantite < $item['quantity']) {
                    throw new \Exception("Stock insuffisant pour le produit: {$product->name}. Demandé: {$item['quantity']}, Disponible: {$product->quantite}");
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'total_price' => $item['price'] * $item['quantity'],
                    'product_sku' => $product->sku,
                ]);

                // Décrémenter le stock
                $product->quantite -= $item['quantity'];
                $product->save();
            }

            DB::commit();

            // Vider le panier
            Session::forget('cart');

            // Rediriger vers une page de confirmation avec l'ID de la commande
            return redirect()->route('checkout.confirmation', ['order' => $order->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error('Erreur lors du traitement de la commande: ' . $e->getMessage());
            return redirect()->route('checkout.index')->with('error', 'Une erreur est survenue lors du traitement de votre commande. Veuillez réessayer. Détail: ' . $e->getMessage());
        }
    }

    /**
     * Affiche la page de confirmation de commande.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function confirmation(Order $order)
    {
        // S'assurer que la commande appartient à la session en cours ou est accessible
        // Pour un client invité, on peut stocker l'ID de la commande en session après la création
        // et vérifier ici. Pour cet exemple, on fait confiance à l'URL pour l'instant.
        // Session::put('last_order_id', $order->id);
        // if (Session::get('last_order_id') != $order->id) {
        //     abort(404); // Ou rediriger
        // }

        return view('ecommerce.confirmation', compact('order'));
    }


    /**
     * Affiche la page de suivi de commande pour un client invité.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function trackOrder(Request $request)
    {
        if ($request->has('order_number') && $request->has('email')) {
            $order = Order::where('order_number', $request->order_number)
                          ->where('customer_email', $request->email)
                          ->first();

            if ($order) {
                return view('ecommerce.order-status', compact('order'));
            } else {
                return redirect()->back()->with('error', 'Commande non trouvée ou email incorrect.')->withInput();
            }
        }
        // Si pas de query params, juste afficher le formulaire de recherche
        return view('ecommerce.order-status-form');
    }


    /**
     * Calcule le total du panier.
     *
     * @param  array  $cart
     * @return float
     */
    private function calculateCartTotal(array $cart): float
    {
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }
        return $total;
    }
}
