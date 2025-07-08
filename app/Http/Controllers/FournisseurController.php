<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFournisseurRequest;
use App\Http\Requests\UpdateFournisseurRequest;
use App\Models\Fournisseur;
use Illuminate\Http\Request; // Ajouté pour la méthode index

class FournisseurController extends Controller
{
    /**
     * Affiche une liste des ressources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // TODO: Ajouter la recherche et le filtrage ici
        $fournisseurs = Fournisseur::latest()->paginate(10); // Pagination ajoutée
        return view('fournisseurs.index', compact('fournisseurs'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle ressource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('fournisseurs.create');
    }

    /**
     * Enregistre une nouvelle ressource dans la base de données.
     *
     * @param  \App\Http\Requests\StoreFournisseurRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreFournisseurRequest $request)
    {
        Fournisseur::create($request->validated());

        return redirect()->route('fournisseurs.index')
            ->with('success', 'Fournisseur créé avec succès.');
    }

    /**
     * Affiche la ressource spécifiée.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\View\View
     */
    public function show(Fournisseur $fournisseur)
    {
        return view('fournisseurs.show', compact('fournisseur'));
    }

    /**
     * Affiche le formulaire de modification de la ressource spécifiée.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\View\View
     */
    public function edit(Fournisseur $fournisseur)
    {
        return view('fournisseurs.edit', compact('fournisseur'));
    }

    /**
     * Met à jour la ressource spécifiée dans la base de données.
     *
     * @param  \App\Http\Requests\UpdateFournisseurRequest  $request
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateFournisseurRequest $request, Fournisseur $fournisseur)
    {
        $fournisseur->update($request->validated());

        return redirect()->route('fournisseurs.index')
            ->with('success', 'Fournisseur mis à jour avec succès.');
    }

    /**
     * Supprime la ressource spécifiée de la base de données.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Fournisseur $fournisseur)
    {
        // TODO: Vérifier si le fournisseur est lié à des articles avant suppression
        $fournisseur->delete();

        return redirect()->route('fournisseurs.index')
            ->with('success', 'Fournisseur supprimé avec succès.');
    }
}
