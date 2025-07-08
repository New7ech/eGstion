<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request; // Garder pour la méthode index
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage; // Ajouté pour la suppression de photo

// Commentés car non utilisés par Route::resource et potentiellement gérés par Fortify/Laravel UI
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Affiche une liste des utilisateurs.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // TODO: Ajouter la recherche et le filtrage
        $users = User::with('roles')->latest()->paginate(10); // Charge les utilisateurs avec leurs rôles et pagine
        return view('users.index', compact('users'));
    }

    /**
     * Affiche le formulaire de création d'un nouvel utilisateur.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id'); // Récupère les rôles pour le formulaire (id => name)
        // $modules = ['sales', 'inventory', 'hr', 'finance']; // Exemple, à adapter si nécessaire
        return view('users.create', compact('roles' /*, 'modules'*/));
    }

    /**
     * Enregistre un nouvel utilisateur dans la base de données.
     *
     * @param \App\Http\Requests\StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($validatedData['password']);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('users/photos', 'public');
            $validatedData['photo'] = $path;
        }

        $user = User::create($validatedData);

        if (!empty($request->roles)) {
            $user->syncRoles($request->roles);
        }

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Affiche l'utilisateur spécifié.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        $user->load('roles'); // S'assurer que les rôles sont chargés
        return view('users.show', compact('user'));
    }

    /**
     * Affiche le formulaire de modification de l'utilisateur spécifié.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');
        $user->load('roles'); // Charger les rôles actuels de l'utilisateur
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Met à jour l'utilisateur spécifié dans la base de données.
     *
     * @param \App\Http\Requests\UpdateUserRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validatedData = $request->validated();

        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']); // Ne pas mettre à jour le mot de passe s'il est vide
        }

        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            $path = $request->file('photo')->store('users/photos', 'public');
            $validatedData['photo'] = $path;
        }

        $user->update($validatedData);

        if (!empty($request->roles)) {
            $user->syncRoles($request->roles);
        } else {
            // Si aucun rôle n'est soumis, potentiellement les supprimer tous
            // ou laisser tel quel selon la logique métier désirée.
            // Pour l'instant, on ne fait rien si $request->roles est vide,
            // ce qui signifie que les rôles existants sont conservés.
            // Si on veut supprimer tous les rôles si aucun n'est coché :
            // $user->syncRoles([]);
        }

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Supprime l'utilisateur spécifié de la base de données.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        // TODO: Ajouter une vérification pour ne pas se supprimer soi-même ou le dernier admin
        // Supprimer la photo de l'utilisateur si elle existe
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur supprimé avec succès.');
    }

    // Les méthodes assignRole, removeRole, checkRole sont généralement gérées
    // par la logique de synchronisation des rôles dans store/update avec Spatie.
    // Si une gestion plus granulaire est nécessaire via des routes dédiées, elles peuvent être conservées.
    // Pour l'instant, je les commente car Route::resource ne les crée pas par défaut.

    /*
    // Méthode pour assigner un rôle à un utilisateur
    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user->assignRole($request->role);

        return redirect()->route('users.index')
            ->with('success', 'Rôle assigné avec succès.');
    }

    // Méthode pour retirer un rôle d'un utilisateur
    public function removeRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user->removeRole($request->role);

        return redirect()->route('users.index')
            ->with('success', 'Rôle retiré avec succès.');
    }

    // Méthode pour vérifier si un utilisateur a un rôle
    public function checkRole(User $user)
    {
        // Exemple: vérifier si l'utilisateur a le rôle 'admin'
        // $hasRole = $user->hasRole('admin');
        // return response()->json(['hasRole' => $hasRole]);
        // Cette méthode est plus pour une vérification API, pas typique pour un CRUD web.
    }
    */

    /*
    // Méthodes de connexion/déconnexion.
    // Laravel UI ou Fortify gèrent généralement cela.
    // Si c'est une authentification personnalisée, ces routes doivent être définies.
    // Pour l'instant, commentées car Route::resource ne les gère pas.

    public function connexion(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('/')
                ->with('success', 'Vous êtes connecté avec succès.');
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification fournies ne correspondent pas à nos enregistrements.',
        ]);
    }

    public function deconnexion()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login')
            ->with('success', 'Vous êtes déconnecté avec succès.');
    }
    */
}
