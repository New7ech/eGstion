<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmplacementRequest;
use App\Http\Requests\UpdateEmplacementRequest;
use App\Models\Emplacement;
use Illuminate\Http\Request; // Ajouté pour la méthode index

class EmplacementController extends Controller
{
    /**
     * Affiche une liste des ressources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // TODO: Ajouter la recherche et la pagination ici si nécessaire
        $emplacements = Emplacement::latest()->paginate(10); // Pagination ajoutée
        return view('emplacements.index', compact('emplacements'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle ressource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('emplacements.create');
    }

    /**
     * Enregistre une nouvelle ressource dans la base de données.
     *
     * @param  \App\Http\Requests\StoreEmplacementRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreEmplacementRequest $request)
    {
        Emplacement::create($request->validated());

        return redirect()->route('emplacements.index')
            ->with('success', 'Emplacement créé avec succès.');
    }

    /**
     * Affiche la ressource spécifiée.
     *
     * @param  \App\Models\Emplacement  $emplacement
     * @return \Illuminate\View\View
     */
    public function show(Emplacement $emplacement)
    {
        return view('emplacements.show', compact('emplacement'));
    }

    /**
     * Affiche le formulaire de modification de la ressource spécifiée.
     *
     * @param  \App\Models\Emplacement  $emplacement
     * @return \Illuminate\View\View
     */
    public function edit(Emplacement $emplacement)
    {
        return view('emplacements.edit', compact('emplacement'));
    }

    /**
     * Met à jour la ressource spécifiée dans la base de données.
     *
     * @param  \App\Http\Requests\UpdateEmplacementRequest  $request
     * @param  \App\Models\Emplacement  $emplacement
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateEmplacementRequest $request, Emplacement $emplacement)
    {
        $emplacement->update($request->validated());

        return redirect()->route('emplacements.index')
            ->with('success', 'Emplacement mis à jour avec succès.');
    }

    /**
     * Supprime la ressource spécifiée de la base de données.
     *
     * @param  \App\Models\Emplacement  $emplacement
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Emplacement $emplacement)
    {
        // TODO: Vérifier si l'emplacement est utilisé par des articles avant de supprimer
        $emplacement->delete();

        return redirect()->route('emplacements.index')
            ->with('success', 'Emplacement supprimé avec succès.');
    }
}
