<?php

namespace App\Http\Controllers;

use App\Models\Article; // Notre modèle Product
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    /**
     * Affiche la page d'accueil e-commerce.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Exemple: Récupérer les produits pour la page d'accueil
        // Ces sections pourront être affinées avec des critères spécifiques
        $newProducts = Article::where('est_visible', true)->orderBy('created_at', 'desc')->take(8)->get();
        $popularProducts = Article::where('est_visible', true)->orderBy('quantite', 'asc')->take(8)->get(); // Exemple de "populaire"
        $promotionalProducts = Article::where('est_visible', true)->whereNotNull('prix_promotionnel')->take(8)->get();

        // Pour la grille principale de produits avec pagination
        $products = Article::where('est_visible', true)->paginate(12); // 12 produits par page

        return view('ecommerce.home', compact('products', 'newProducts', 'popularProducts', 'promotionalProducts'));
    }
}
