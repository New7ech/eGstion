<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request; // Garder pour la méthode index
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Affiche une liste des rôles.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // TODO: Ajouter recherche/filtrage si nécessaire
        $roles = Role::withCount('permissions')->latest()->paginate(10);
        return view('roles.index', compact('roles'));
    }

    /**
     * Affiche le formulaire de création d'un nouveau rôle.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $permissions = Permission::orderBy('name')->pluck('name', 'id');
        return view('roles.create', compact('permissions'));
    }

    /**
     * Enregistre un nouveau rôle dans la base de données.
     *
     * @param \App\Http\Requests\StoreRoleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRoleRequest $request)
    {
        $role = Role::create(['name' => $request->name, 'guard_name' => 'web']); // guard_name est souvent 'web' par défaut

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')
            ->with('success', 'Rôle créé avec succès.');
    }

    /**
     * Affiche le formulaire de modification du rôle spécifié.
     *
     * @param \Spatie\Permission\Models\Role $role
     * @return \Illuminate\View\View
     */
    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('name')->pluck('name', 'id');
        $role->load('permissions'); // Charger les permissions actuelles du rôle
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Met à jour le rôle spécifié dans la base de données.
     *
     * @param \App\Http\Requests\UpdateRoleRequest $request
     * @param \Spatie\Permission\Models\Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        } else {
            $role->syncPermissions([]); // Si aucun permission n'est cochée, les supprimer toutes
        }

        return redirect()->route('roles.index')
            ->with('success', 'Rôle mis à jour avec succès.');
    }

    /**
     * Supprime le rôle spécifié de la base de données.
     *
     * @param \Spatie\Permission\Models\Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role)
    {
        // TODO: Vérifier si le rôle est utilisé par des utilisateurs avant de supprimer
        // Spatie/laravel-permission ne supprime pas les rôles assignés par défaut, mais il est bon de vérifier.
        if ($role->users()->count() > 0) {
            return redirect()->route('roles.index')
                ->with('error', 'Impossible de supprimer ce rôle car il est assigné à des utilisateurs.');
        }
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Rôle supprimé avec succès.');
    }
}
