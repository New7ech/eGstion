<?php

namespace App\Http\Controllers;

use App\Models\Article; // Notre modèle Product
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Affiche la page de détail d'un produit.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function show(string $slug)
    {
        $product = Article::where('slug', $slug)->where('est_visible', true)->firstOrFail();

        // Exemple: Récupérer des produits recommandés/similaires
        // Basé sur la même catégorie, excluant le produit actuel
        $recommendedProducts = Article::where('est_visible', true)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('ecommerce.product', compact('product', 'recommendedProducts'));
    }

    /**
     * Permet de filtrer les produits (utilisé par la page d'accueil ou une page catalogue dédiée).
     * Cette méthode pourrait être dans EcommerceController aussi, selon l'organisation souhaitée.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function filter(Request $request)
    {
        $query = Article::where('est_visible', true);

        // Filtre par catégorie
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filtre par prix
        if ($request->filled('min_price')) {
            $query->where('prix', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('prix', '<=', $request->max_price);
        }

        // Filtre par disponibilité (en stock)
        if ($request->has('in_stock')) {
            $query->where('quantite', '>', 0);
        }

        // Tri
        if ($request->filled('sort_by')) {
            switch ($request->sort_by) {
                case 'price_asc':
                    $query->orderBy('prix', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('prix', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc'); // Tri par défaut
        }

        $products = $query->paginate(12)->withQueryString(); // withQueryString pour conserver les filtres dans la pagination

        // Idéalement, on réutiliserait la vue de la grille de produits
        // ou une vue spécifique pour les résultats filtrés.
        // Pour l'instant, on peut imaginer que cela recharge la section produits de la page d'accueil
        // ou une page de catalogue.
        // Pour cet exemple, on va supposer que c'est appelé via AJAX ou que ça recharge une vue spécifique.

        // Si appelé via AJAX, retourner du JSON:
        // if ($request->ajax()) {
        //     return response()->json(['products' => $products, 'view' => view('ecommerce.partials.product_grid', compact('products'))->render()]);
        // }

        // Pour un rechargement de page complet (ou une page dédiée au catalogue/recherche)
        // On récupère également les catégories pour les filtres
        $categories = \App\Models\Categorie::orderBy('name')->get();
        return view('ecommerce.catalog', compact('products', 'categories')); // Supposons une vue catalog.blade.php
    }
}
