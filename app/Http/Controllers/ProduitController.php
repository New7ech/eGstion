<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Si vous avez un modèle Produit spécifique pour l'e-commerce, importez-le ici.
// Exemple: use App\Models\ProduitEcommerce as Produit;
// Sinon, vous pourriez utiliser le modèle Article existant ou un autre.
// Pour l'instant, on simule sans modèle direct.

class ProduitController extends Controller
{
    /**
     * Affiche la liste des produits (catalogue).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Logique pour récupérer et afficher tous les produits
        // Exemple de données factices:
        $produits = collect([
            (object)['id' => 1, 'slug' => 'produit-alpha', 'name' => 'Produit Alpha', 'image_url' => 'https://picsum.photos/seed/prod_alpha/400/300', 'price' => 29.99, 'category_name' => 'Nouveautés'],
            (object)['id' => 2, 'slug' => 'article-beta-premium', 'name' => 'Article Beta Premium', 'image_url' => 'https://picsum.photos/seed/prod_beta/400/300', 'price' => 45.50, 'category_name' => 'Meilleures Ventes'],
        ]);

        // Il faudra créer cette vue
        return view('ecommerce.produits.index', compact('produits'));
    }

    /**
     * Affiche les détails d'un produit spécifique.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // Logique pour récupérer un produit par son slug
        // Exemple de données factices:
        $produit = (object)['id' => 1, 'slug' => $slug, 'name' => 'Détail du ' . ucfirst(str_replace('-', ' ', $slug)), 'image_url' => 'https://picsum.photos/seed/'.$slug.'/800/600', 'price' => 29.99, 'description' => 'Ceci est une description détaillée du produit.', 'category_name' => 'Nouveautés'];

        // Il faudra créer cette vue
        if (!$produit) {
            // Si le produit n'est pas trouvé, rediriger vers une page d'erreur ou la liste des produits
            // return redirect()->route('ecommerce.produits.index')->with('erreur', 'Produit non trouvé.');
            // Pour l'instant, on crée une vue même si non trouvé pour respecter la consigne
        }
        return view('ecommerce.produits.show', compact('produit'));
    }
}
