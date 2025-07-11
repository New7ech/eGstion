<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Models\Categorie;
use Illuminate\Http\Request;
// Supposons que les produits de l'e-commerce sont liés aux catégories.
// Si vous avez un modèle Produit spécifique pour l'e-commerce:
// use App\Models\ProduitEcommerce as Produit;
// Sinon, utilisez le modèle Article ou adaptez.
// Pour la simulation, nous n'utiliserons pas Article ici directement pour éviter des dépendances non gérées dans ce contexte.

class CategorieController extends Controller
{
    /**
     * Affiche une liste des ressources (pour la gestion ERP/Admin).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function indexErp(Request $request) // Renommée pour distinguer de la méthode show e-commerce
    {
        $categories = Categorie::latest()->paginate(10);
        // Vue pour la gestion des catégories dans l'ERP/Admin
        return view('categories.index', compact('categories'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle ressource (pour la gestion ERP/Admin).
     *
     * @return \Illuminate\View\View
     */
    public function createErp() // Renommée
    {
        // Vue pour créer une catégorie dans l'ERP/Admin
        return view('categories.create');
    }

    /**
     * Enregistre une nouvelle ressource dans la base de données (pour la gestion ERP/Admin).
     *
     * @param  \App\Http\Requests\StoreCategorieRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeErp(StoreCategorieRequest $request) // Renommée
    {
        Categorie::create($request->validated());
        // Redirige vers l'index ERP des catégories
        return redirect()->route('categories.index') // Assurez-vous que cette route pointe vers indexErp ou ajustez
            ->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Affiche les produits d'une catégorie spécifique (pour la partie E-commerce).
     * La route 'ecommerce.categories.show' pointe ici.
     * La méthode originale show(Categorie $categorie) est conservée pour l'instant si elle est utilisée par l'ERP.
     * Pour éviter les conflits de signature si `Route::resource` est utilisé sans `except`,
     * il est préférable de donner un nom unique à cette méthode pour l'e-commerce.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showEcommerce($slug)
    {
        $categorie = Categorie::where('slug', $slug)->first();

        if (!$categorie) {
            // Gérer le cas où la catégorie n'est pas trouvée
            // Peut-être rediriger vers une page d'erreur ou une liste de catégories
            return redirect()->route('ecommerce.home')->with('erreur', 'Catégorie non trouvée.');
        }

        // Récupérer les produits associés à cette catégorie
        // Ceci est une simulation. Vous devrez adapter à votre structure de données.
        // Par exemple, si les Articles (produits) ont une category_id:
        // $produits = \App\Models\Article::where('category_id', $categorie->id)
        //                                ->where('est_pour_ecommerce', true) // si vous avez un tel champ
        //                                ->get();

        // Données factices pour la vue:
        $produits = collect([
            (object)['id' => 1, 'slug' => 'produit-alpha-cat-'.$slug, 'name' => 'Produit Alpha (Cat: '.$categorie->nom.')', 'image_url' => 'https://picsum.photos/seed/prod_alpha_cat_'.$slug.'/400/300', 'price' => 29.99, 'category_name' => $categorie->nom],
            (object)['id' => 2, 'slug' => 'produit-beta-cat-'.$slug, 'name' => 'Produit Beta (Cat: '.$categorie->nom.')', 'image_url' => 'https://picsum.photos/seed/prod_beta_cat_'.$slug.'/400/300', 'price' => 45.50, 'category_name' => $categorie->nom],
        ]);

        // Il faudra créer cette vue: resources/views/ecommerce/categories/show.blade.php
        return view('ecommerce.categories.show', compact('categorie', 'produits'));
    }

    /**
     * Affiche la ressource spécifiée (pour la gestion ERP/Admin, si nécessaire).
     * Si `Route::resource('categories', CategorieController::class)` est utilisé, cette méthode est attendue.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\View\View
     */
    public function show(Categorie $categorie) // Gardée pour compatibilité avec Route::resource pour l'ERP
    {
        // Cette vue est pour afficher une catégorie spécifique dans l'ERP/Admin (si différent de showEcommerce)
        // Si non utilisée, elle peut être retirée si `except` est utilisé dans la définition de la route resource.
        return view('categories.show', compact('categorie')); // Pointe vers la vue ERP
    }


    /**
     * Affiche le formulaire de modification de la ressource spécifiée (pour la gestion ERP/Admin).
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\View\View
     */
    public function edit(Categorie $categorie)
    {
        return view('categories.edit', compact('categorie'));
    }

    /**
     * Met à jour la ressource spécifiée dans la base de données.
     *
     * @param  \App\Http\Requests\UpdateCategorieRequest  $request
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {
        $categorie->update($request->validated());

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie mise à jour avec succès.');
    }

    /**
     * Supprime la ressource spécifiée de la base de données.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Categorie $categorie)
    {
        // TODO: Vérifier si la catégorie est utilisée par des articles avant de supprimer
        // ou gérer la suppression en cascade / mise à null dans la base de données.
        $categorie->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }
}
