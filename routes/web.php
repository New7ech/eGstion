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
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommandeController; // Ajouté pour la gestion des commandes
use App\Http\Controllers\ProduitController; // Ajouté pour la gestion des produits e-commerce
use App\Http\Controllers\PanierController; // Ajouté pour la gestion du panier e-commerce
// Supposition: CategorieController gérera aussi les catégories e-commerce, sinon créer un contrôleur dédié.
use App\Models\Accueil;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all ofthem will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route d'accueil principale (actuellement le tableau de bord de l'ERP)
Route::get('/', [AccueilController::class, 'index'])->name('accueil');

// Gestion des utilisateurs et des rôles (Partie ERP/Admin)
Route::middleware(['auth'])->group(function () { // Protéger ces routes si nécessaire
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    // Gestion de l'inventaire et autres fonctionnalités ERP
    // Commentaire: Gestion des catégories de produits pour l'ERP
    Route::resource('categories', CategorieController::class)->except(['show']);
    Route::resource('fournisseurs', FournisseurController::class);
    Route::resource('emplacements', EmplacementController::class);
    // Commentaire: Gestion des articles pour l'ERP (inventaire général)
    Route::resource('articles', ArticleController::class);
    Route::resource('factures', FactureController::class);
    Route::get('/factures/{facture}/pdf', [FactureController::class, 'genererPdf'])->name('factures.pdf');
    Route::get('/statistiques', [StatistiqueController::class, 'index'])->name('statistiques.index');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
});


/*
|--------------------------------------------------------------------------
| Routes E-commerce
|--------------------------------------------------------------------------
|
| Routes dédiées à la partie boutique en ligne du site.
| Préfixe: /shop
| Nom de groupe: ecommerce.
*/
Route::group(['prefix' => 'shop', 'as' => 'ecommerce.'], function () {

    // Page d'accueil de la boutique
    Route::get('/', [EcommerceController::class, 'index'])->name('home');

    // Produits
    // Route pour la liste des produits (catalogue)
    Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
    // Route pour afficher un produit spécifique (détail produit)
    // Utilise 'slug' pour une URL plus SEO-friendly, mais on pourrait aussi utiliser 'id'
    Route::get('/produit/{slug}', [ProduitController::class, 'show'])->name('produits.show');
    // Route de filtrage (si utilisée par home.blade.php, sinon EcommerceProductController::filter est déjà là)
    // Si EcommerceProductController::filter est le bon, on le garde. Sinon, on le redirige vers ProduitController.
    // Pour l'instant, on garde la route existante 'products.filter' car elle est utilisée.
    Route::get('/products/filter', [EcommerceProductController::class, 'filter'])->name('products.filter');


    // Catégories de produits (pour la boutique)
    // Si CategorieController gère à la fois ERP et e-commerce avec des vues/logiques différentes,
    // il faudra peut-être des méthodes distinctes ou un contrôleur e-commerce dédié pour les catégories.
    // La méthode 'showEcommerce' a été créée dans CategorieController pour cela.
    // Commentaire: Afficher les produits d'une catégorie spécifique pour l'e-commerce
    Route::get('/categorie/{slug}', [CategorieController::class, 'showEcommerce'])->name('categories.show');

    // Panier
    // Route pour afficher le contenu du panier
    Route::get('/panier', [PanierController::class, 'index'])->name('panier.index');
    // Route pour ajouter un produit au panier (POST)
    Route::post('/panier/ajouter', [PanierController::class, 'ajouter'])->name('panier.ajouter');
    // Les routes existantes pour le panier sont conservées et adaptées si PanierController les remplace
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update'); // Peut être géré par PanierController@update
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove'); // Peut être géré par PanierController@remove
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');   // Peut être géré par PanierController@clear
    Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');     // Peut être utile pour AJAX

    // Commande (Checkout)
    // Route pour afficher la page de paiement/finalisation de commande
    Route::get('/commande/checkout', [CommandeController::class, 'checkout'])->name('commande.checkout');
    // Route pour traiter la commande (POST)
    Route::post('/commande/process', [CommandeController::class, 'process'])->name('commande.process');
    // Route pour la page de confirmation de commande
    Route::get('/commande/confirmation/{order}', [CommandeController::class, 'confirmation'])->name('commande.confirmation');

    // Suivi de commande (si existant dans CheckoutController)
    Route::get('/order-tracking', [CheckoutController::class, 'trackOrder'])->name('order.track');
    // La soumission du formulaire de suivi pointera aussi sur 'ecommerce.order.track' mais avec méthode POST ou GET avec params
});

// Pages statiques (Exemples: À Propos, Contact)
// Ces routes peuvent être ajoutées ici si nécessaire.
// Route::get('/a-propos', function() { return view('pages.a-propos'); })->name('pages.apropos');
// Route::get('/contact', function() { return view('pages.contact'); })->name('pages.contact');


// Note: La route d'accueil générale '/' pointe toujours vers AccueilController (tableau de bord ERP).
// La boutique est accessible via /shop.
// Si la page d'accueil principale du site doit devenir la boutique, il faudra ajuster:
// Route::get('/', [EcommerceController::class, 'index'])->name('home'); // et renommer l'actuelle 'ecommerce.home'
// et déplacer l'ancienne page d'accueil de l'ERP (si elle doit toujours exister) vers une autre route (ex: /dashboard).
