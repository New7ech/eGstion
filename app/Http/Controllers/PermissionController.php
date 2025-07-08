<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Illuminate\Http\Request; // Garder pour la méthode index
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Affiche une liste des permissions.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // TODO: Ajouter recherche/filtrage si nécessaire
        $permissions = Permission::latest()->paginate(10);
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle permission.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Enregistre une nouvelle permission dans la base de données.
     *
     * @param \App\Http\Requests\StorePermissionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePermissionRequest $request)
    {
        // Le guard_name 'web' est généralement utilisé par défaut par Spatie.
        // Si vous avez plusieurs guards, vous pourriez vouloir le rendre configurable.
        Permission::create(['name' => $request->name, 'guard_name' => 'web']);

        return redirect()->route('permissions.index')
            ->with('success', 'Permission créée avec succès.');
    }

    /**
     * Affiche le formulaire de modification de la permission spécifiée.
     * (Spatie ne prévoit généralement pas de "voir" une permission seule, mais l'édition oui)
     *
     * @param \Spatie\Permission\Models\Permission $permission
     * @return \Illuminate\View\View
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Met à jour la permission spécifiée dans la base de données.
     *
     * @param \App\Http\Requests\UpdatePermissionRequest $request
     * @param \Spatie\Permission\Models\Permission $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update(['name' => $request->name]);

        return redirect()->route('permissions.index')
            ->with('success', 'Permission mise à jour avec succès.');
    }

    /**
     * Supprime la permission spécifiée de la base de données.
     *
     * @param \Spatie\Permission\Models\Permission $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Permission $permission)
    {
        // Spatie gère la dissociation des rôles lors de la suppression d'une permission.
        // Il est bon de vérifier si la permission est utilisée par des rôles critiques.
        if ($permission->roles()->count() > 0) {
             return redirect()->route('permissions.index')
                ->with('error', 'Impossible de supprimer cette permission car elle est assignée à des rôles.');
        }
        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('success', 'Permission supprimée avec succès.');
    }
}
