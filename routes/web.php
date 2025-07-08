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
use App\Http\Controllers\EcommerceController; // Ajouté
use App\Http\Controllers\ProductController as EcommerceProductController; // Renommé pour éviter conflit
use App\Http\Controllers\CartController; // Ajouté
use App\Http\Controllers\CheckoutController; // Ajouté
use App\Models\Accueil;
use Illuminate\Support\Facades\Route;



//la gestion des utilisateurs
Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class);
Route::resource('categories', CategorieController::class);
Route::resource('fournisseurs', FournisseurController::class);
Route::resource('emplacements',EmplacementController::class);
Route::resource('articles', ArticleController::class);
Route::resource('factures', FactureController::class);
Route::resource('accueil', AccueilController::class);
Route::get('/', [App\Http\Controllers\AccueilController::class, 'index'])->name('accueil');

Route::get('/factures/{facture}/pdf', [FactureController::class, 'genererPdf'])->name('factures.pdf');
Route::get('/statistiques', [StatistiqueController::class, 'index'])->name('statistiques.index');

// Notification routes
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');
Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');


// Route::get('/', function () {
//     return view('welcome');
// });


// Routes E-commerce
Route::group(['prefix' => 'shop', 'as' => 'ecommerce.'], function () {
    Route::get('/', [EcommerceController::class, 'index'])->name('home'); // Page d'accueil e-commerce

    // Affichage des produits
    Route::get('/product/{slug}', [EcommerceProductController::class, 'show'])->name('product.show');
    Route::get('/products/filter', [EcommerceProductController::class, 'filter'])->name('products.filter'); // Pour les filtres AJAX ou page catalogue

    // Panier
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count'); // Pour récupérer le nombre d'articles (AJAX)

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');

    // Suivi de commande (client invité)
    Route::get('/order-tracking', [CheckoutController::class, 'trackOrder'])->name('order.track');
    // La soumission du formulaire de suivi pointera aussi sur 'ecommerce.order.track' mais avec méthode POST ou GET avec params
});

// Note: La route d'accueil générale '/' pointe toujours vers AccueilController.
// Si la page d'accueil principale du site doit devenir la boutique, il faudra ajuster cela.
// Par exemple: Route::get('/', [EcommerceController::class, 'index'])->name('home');
// et déplacer l'ancienne page d'accueil (si elle doit toujours exister) vers une autre route.
// Pour l'instant, la boutique est accessible via /shop
