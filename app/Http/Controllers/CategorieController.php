<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Models\Categorie;
use Illuminate\Http\Request; // Ajouté pour la méthode index si on veut ajouter une recherche plus tard

class CategorieController extends Controller
{
    /**
     * Affiche une liste des ressources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request) // Ajout de Request pour une future recherche/filtrage
    {
        // TODO: Ajouter la recherche et la pagination ici si nécessaire
        $categories = Categorie::latest()->paginate(10); // Pagination ajoutée, ajuster le nombre au besoin
        return view('categories.index', compact('categories'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle ressource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Enregistre une nouvelle ressource dans la base de données.
     *
     * @param  \App\Http\Requests\StoreCategorieRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCategorieRequest $request)
    {
        Categorie::create($request->validated());

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Affiche la ressource spécifiée.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\View\View
     */
    public function show(Categorie $categorie)
    {
        return view('categories.show', compact('categorie'));
    }

    /**
     * Affiche le formulaire de modification de la ressource spécifiée.
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
