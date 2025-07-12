<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\EmplacementController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\EcommerceController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\CommandeController;
// Note: CartController et CheckoutController pourraient être supprimés si leur logique est entièrement migrée.
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController as EcommerceProductController; // Gardé pour la route de filtre temporairement

use App\Models\Accueil;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route d'accueil principale (actuellement le tableau de bord de l'ERP)
Route::get('/', [AccueilController::class, 'index'])->name('accueil');

// Gestion des utilisateurs et des rôles (Partie ERP/Admin)
Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('categories', CategorieController::class)->except(['show']);
    Route::resource('fournisseurs', FournisseurController::class);
    Route::resource('emplacements', EmplacementController::class);
    Route::resource('articles', ArticleController::class);
    Route::resource('factures', FactureController::class);
    Route::get('/factures/{facture}/pdf', [FactureController::class, 'genererPdf'])->name('factures.pdf');
    Route::get('/statistiques', [StatistiqueController::class, 'index'])->name('statistiques.index');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
});


/*
|--------------------------------------------------------------------------
| Routes E-commerce
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'shop', 'as' => 'ecommerce.'], function () {

    // Page d'accueil de la boutique
    Route::get('/', [EcommerceController::class, 'index'])->name('home');

    // Articles (boutique)
    Route::get('/articles', [ArticleController::class, 'indexEcommerce'])->name('articles.index');
    Route::get('/article/{slug}', [ArticleController::class, 'showEcommerce'])->name('articles.show');
    // Route de filtre legacy - à migrer
    Route::get('/products/filter', [EcommerceProductController::class, 'filter'])->name('products.filter');

    // Catégories d'articles
    Route::get('/categorie/{slug}', [CategorieController::class, 'showEcommerce'])->name('categories.show');

    // Panier (consolidé sur PanierController)
    Route::get('/panier', [PanierController::class, 'index'])->name('panier.index');
    Route::post('/panier/ajouter', [PanierController::class, 'ajouter'])->name('panier.ajouter');
    Route::post('/panier/vider', [PanierController::class, 'vider'])->name('panier.vider');
    Route::get('/panier/count', [PanierController::class, 'count'])->name('panier.count');
    // TODO: Ajouter les routes pour mettre à jour et supprimer un article du panier dans PanierController
    // Route::post('/panier/update', [PanierController::class, 'update'])->name('panier.update');
    // Route::post('/panier/remove', [PanierController::class, 'remove'])->name('panier.remove');

    // Commande (Checkout)
    Route::get('/commande/checkout', [CommandeController::class, 'checkout'])->name('commande.checkout');
    Route::post('/commande/process', [CommandeController::class, 'process'])->name('commande.process');
    Route::get('/commande/confirmation/{order}', [CommandeController::class, 'confirmation'])->name('commande.confirmation');

    // Suivi de commande
    Route::get('/order-tracking', [CheckoutController::class, 'trackOrder'])->name('order.track');
});
