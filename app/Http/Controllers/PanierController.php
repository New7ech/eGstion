<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Importer le modèle de Produit si nécessaire pour récupérer les détails
// use App\Models\ProduitEcommerce as Produit;

class PanierController extends Controller
{
    /**
     * Affiche le contenu du panier.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Logique pour récupérer le panier depuis la session ou la base de données
        $panierItems = session()->get('panier', []); // Exemple avec la session

        // Il faudra créer cette vue
        return view('ecommerce.panier.index', compact('panierItems'));
    }

    /**
     * Ajoute un produit au panier.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajouter(Request $request)
    {
        // Valider la requête (ex: product_id, quantity)
        $request->validate([
            'product_id' => 'required|integer', // Supposons qu'on passe un ID de produit
            'quantity' => 'sometimes|integer|min:1'
        ]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        // Logique pour ajouter le produit au panier (session, base de données, etc.)
        // Exemple simple avec la session:
        $panier = session()->get('panier', []);

        if(isset($panier[$productId])) {
            $panier[$productId]['quantity'] += $quantity;
        } else {
            // Ici, vous récupéreriez normalement les détails du produit depuis la base de données
            $panier[$productId] = [
                "name" => "Produit " . $productId, // Simulé
                "quantity" => $quantity,
                "price" => 20.00, // Simulé
                "image_url" => 'https://picsum.photos/seed/product'.$productId.'/100/100' // Simulé
            ];
        }
        session()->put('panier', $panier);

        // Rediriger vers la page du panier avec un message de succès
        // ou retourner une réponse JSON si c'est un appel AJAX

        // Pour simuler la fonctionnalité sans backend complet et respecter la consigne JS:
        // On pourrait rediriger et la vue panier.index afficherait l'alert.
        // Ou, si le bouton doit juste afficher une alerte sans recharger:
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Produit ajouté au panier ! (simulé)', 'cart_count' => count($panier)]);
        }

        // Comportement par défaut: redirection vers le panier.
        return redirect()->route('ecommerce.panier.index')->with('succes', 'Produit ajouté au panier !');
    }

    // D'autres méthodes peuvent être ajoutées ici: mettreAJour, supprimer, vider, etc.
    // Ces méthodes correspondraient aux routes ecommerce.cart.update, ecommerce.cart.remove, ecommerce.cart.clear
    // qui sont actuellement liées à CartController. Il faudrait décider si PanierController les prend en charge.
    // Pour l'instant, on se concentre sur les méthodes demandées explicitement.
}
