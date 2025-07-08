<?php

namespace App\Http\Controllers;

use App\Models\Article; // Notre modèle Product
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Affiche la page du panier.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = $this->calculateCartTotal($cart);

        // Enrichir les items du panier avec les détails des produits si nécessaire
        // (par exemple, pour afficher l'image, etc., bien que le nom et prix soient déjà stockés)
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
                    'image_url' => $productsDetails[$id]->image_url, // Assumant un accesseur getImageUrlAttribute sur Article
                    'slug' => $productsDetails[$id]->slug,
                ];
            }
        }


        return view('ecommerce.cart', compact('cartItems', 'total'));
    }

    /**
     * Ajoute un produit au panier.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:articles,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Article::findOrFail($request->product_id);
        $cart = Session::get('cart', []);

        // Vérifier si le stock est suffisant
        $currentQuantityInCart = isset($cart[$product->id]) ? $cart[$product->id]['quantity'] : 0;
        if ($product->quantite < ($currentQuantityInCart + $request->quantity)) {
            return redirect()->back()->with('error', 'Quantité demandée non disponible en stock.');
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => $request->quantity,
                "price" => $product->prix_promotionnel ?? $product->prix, // Utilise le prix promo s'il existe
                "image_principale" => $product->image_principale // ou $product->image_url si vous avez un accesseur
            ];
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier !');
    }

    /**
     * Met à jour la quantité d'un article dans le panier.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:articles,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Session::get('cart', []);
        $product = Article::findOrFail($request->product_id);

        if (isset($cart[$request->product_id])) {
            // Vérifier le stock avant de mettre à jour
            if ($product->quantite < $request->quantity) {
                return redirect()->route('cart.index')->with('error', 'Quantité demandée pour "' . $product->name . '" non disponible en stock.');
            }
            $cart[$request->product_id]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Panier mis à jour.');
        }

        return redirect()->route('cart.index')->with('error', 'Produit non trouvé dans le panier.');
    }

    /**
     * Supprime un article du panier.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:articles,id',
        ]);

        $cart = Session::get('cart', []);

        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            Session::put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Produit retiré du panier.');
        }

        return redirect()->route('cart.index')->with('error', 'Produit non trouvé dans le panier.');
    }

    /**
     * Vide complètement le panier.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear()
    {
        Session::forget('cart');
        return redirect()->route('cart.index')->with('success', 'Le panier a été vidé.');
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

    /**
     * Récupère le nombre d'articles dans le panier (pour l'affichage dans le header par exemple).
     * Cette méthode pourrait être appelée via AJAX ou utilisée dans un View Composer.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function count()
    {
        $cart = Session::get('cart', []);
        $count = 0;
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        return response()->json(['count' => $count]);
    }
}
