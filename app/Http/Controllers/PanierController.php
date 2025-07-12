<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class PanierController extends Controller
{
    /**
     * Affiche le contenu du panier.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $panierItems = session()->get('panier', []);
        return view('ecommerce.panier.index', compact('panierItems'));
    }

    /**
     * Ajoute un article au panier.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ajouter(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'quantity' => 'sometimes|integer|min:1'
        ]);

        $articleId = $request->input('article_id');
        $quantity = $request->input('quantity', 1);
        $article = Article::findOrFail($articleId);

        // Vérifier si le stock est suffisant
        if ($article->quantite < $quantity) {
            return back()->with('erreur', 'Stock insuffisant pour l\'article : ' . $article->name);
        }

        $panier = session()->get('panier', []);

        // Si l'article est déjà dans le panier, on incrémente la quantité
        if (isset($panier[$articleId])) {
            // Vérifier que la nouvelle quantité ne dépasse pas le stock
            if ($article->quantite < $panier[$articleId]['quantity'] + $quantity) {
                return back()->with('erreur', 'Stock insuffisant pour ajouter cette quantité de : ' . $article->name);
            }
            $panier[$articleId]['quantity'] += $quantity;
        } else {
            // Sinon, on ajoute l'article au panier
            $panier[$articleId] = [
                "name" => $article->name,
                "quantity" => $quantity,
                "price" => $article->prix_promotionnel ?? $article->prix,
                "image_url" => $article->image_url, // Utilise l'accessor
                "slug" => $article->slug
            ];
        }

        session()->put('panier', $panier);

        return redirect()->route('ecommerce.panier.index')->with('succes', 'Article ajouté au panier !');
    }

    /**
     * Vide complètement le panier.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function vider()
    {
        session()->forget('panier');

        return redirect()->route('ecommerce.panier.index')->with('succes', 'Le panier a été vidé.');
    }

    /**
     * Retourne le nombre d'articles dans le panier (pour AJAX).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function count()
    {
        $panier = session()->get('panier', []);
        $count = count($panier); // Compte le nombre de lignes uniques dans le panier

        // Ou si vous voulez le nombre total d'unités :
        // $count = array_sum(array_column($panier, 'quantity'));

        return response()->json(['count' => $count]);
    }

    // TODO: Implémenter les méthodes update() et remove() pour une gestion fine du panier.
}
