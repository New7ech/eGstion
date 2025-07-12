<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;

class EcommerceController extends Controller
{
    /**
     * Affiche la page d'accueil e-commerce avec les articles phares et les catégories.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupérer les 8 derniers articles visibles pour la section "Articles Étoiles"
        $articlesPhares = Article::where('est_visible', true)
                                 ->latest() // Ordonné par date de création, le plus récent en premier
                                 ->take(8)
                                 ->get();

        // Récupérer jusqu'à 4 catégories à afficher sur la page d'accueil
        // On pourrait ajouter un critère comme 'est_populaire' si le modèle Categorie l'avait
        $categories = Categorie::take(4)->get();

        // Passer les données à la vue
        return view('ecommerce.home', compact('articlesPhares', 'categories'));
    }
}
