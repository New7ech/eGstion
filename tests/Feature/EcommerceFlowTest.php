<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase; // Optionnel, si on veut réinitialiser la BDD pour chaque test
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Article; // Notre modèle Produit
use App\Models\Categorie; // Si nécessaire pour créer des produits
use App\Models\Order;

class EcommerceFlowTest extends TestCase
{
    // Décommenter si vous voulez une base de données fraîche pour chaque test de cette classe
    // Attention: cela ralentit les tests. Peut être géré au niveau du groupe de tests ou globalement.
    // use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Créer une catégorie par défaut si elle n'existe pas, pour les produits
        // Ceci est un exemple, ajustez selon votre logique de seeding ou vos factories
        if (Categorie::count() == 0) {
            Categorie::create(['name' => 'Catégorie Test']);
        }
    }

    /**
     * Teste l'affichage de la page d'accueil e-commerce.
     *
     * @return void
     */
    public function test_ecommerce_home_page_loads_correctly(): void
    {
        // Créer quelques articles pour s'assurer que la page n'est pas vide
        Article::factory()->count(3)->create(['est_visible' => true]);

        $response = $this->get(route('ecommerce.home'));

        $response->assertStatus(200);
        $response->assertSeeText('Nos Produits'); // Vérifier un texte clé de la page d'accueil
    }

    /**
     * Teste l'affichage d'une page produit détaillée.
     *
     * @return void
     */
    public function test_product_detail_page_loads_correctly(): void
    {
        $product = Article::factory()->create(['est_visible' => true, 'slug' => 'test-produit-pour-detail']);

        $response = $this->get(route('ecommerce.product.show', $product->slug));

        $response->assertStatus(200);
        $response->assertSeeText($product->name);
        $response->assertSeeText('Ajouter au panier');
    }

    /**
     * Teste l'ajout d'un produit au panier.
     *
     * @return void
     */
    public function test_product_can_be_added_to_cart(): void
    {
        $product = Article::factory()->create(['est_visible' => true, 'quantite' => 10]);

        $response = $this->post(route('ecommerce.cart.add'), [
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        $response->assertRedirect(route('ecommerce.cart.index'));
        $response->assertSessionHas('cart.' . $product->id); // Vérifie que le produit est dans la session du panier

        // Vérifier que la page panier affiche le produit
        $this->get(route('ecommerce.cart.index'))
            ->assertStatus(200)
            ->assertSeeText($product->name);
    }

    /**
     * Teste le processus de commande (checkout).
     *
     * @return void
     */
    public function test_checkout_process_creates_order(): void
    {
        $product = Article::factory()->create(['est_visible' => true, 'quantite' => 10, 'prix' => 100.00]);
        $initialStock = $product->quantite;

        // 1. Ajouter au panier (simulé via session directement pour simplifier le test du checkout)
        $cartData = [
            $product->id => [
                'name' => $product->name,
                'quantity' => 2,
                'price' => $product->prix,
                'image_principale' => $product->image_principale
            ]
        ];

        // Simuler la session du panier
        session(['cart' => $cartData]);

        $checkoutData = [
            'customer_name' => 'Test User',
            'customer_email' => 'test@example.com',
            'shipping_address_line1' => '123 Test Street',
            'shipping_address_city' => 'Testville',
            'shipping_address_postal_code' => '12345',
            'shipping_address_country' => 'Testland',
            'payment_method' => 'cash_on_delivery',
        ];

        $response = $this->post(route('ecommerce.checkout.process'), $checkoutData);

        // Vérifier la redirection vers la page de confirmation
        // $response->assertRedirectContains(route('ecommerce.checkout.confirmation', [], false)); // url incomplète
        // On va plutôt vérifier qu'une commande a été créée et que le stock a diminué

        $this->assertDatabaseHas('orders', [
            'customer_email' => 'test@example.com',
            // 'total_amount' => 205.00 // 2 * 100.00 + 5.00 shipping
        ]);

        // Récupérer la commande pour vérifier le total_amount précisément
        $order = Order::where('customer_email', 'test@example.com')->first();
        $this->assertNotNull($order);
        $this->assertEquals(205.00, (float) $order->total_amount); // 2 produits à 100€ + 5€ de port

        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        // Vérifier la mise à jour du stock
        $product->refresh();
        $this->assertEquals($initialStock - 2, $product->quantite);

        // Vérifier que le panier est vidé après la commande
        $response->assertSessionMissing('cart');
        // La redirection se fait vers la page de confirmation avec l'objet Order
        $response->assertRedirect(route('ecommerce.checkout.confirmation', ['order' => $order->id]));

        // Vérifier que la page de confirmation se charge
         $this->get(route('ecommerce.checkout.confirmation', ['order' => $order->id]))
             ->assertStatus(200)
             ->assertSeeText($order->order_number);

    }

    /**
     * Teste que l'ajout au panier échoue si le stock est insuffisant.
     */
    public function test_cannot_add_to_cart_if_stock_is_insufficient(): void
    {
        $product = Article::factory()->create(['quantite' => 1, 'est_visible' => true]);

        // Tenter d'ajouter 2 produits alors qu'il n'y en a qu'1 en stock
        $response = $this->post(route('ecommerce.cart.add'), [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $response->assertRedirect(); // Redirige vers la page précédente
        $response->assertSessionHas('error'); // S'attend à un message d'erreur
        $response->assertSessionMissing('cart.' . $product->id); // Le produit ne doit pas être dans le panier
    }

     /**
     * Teste que la commande échoue si le stock devient insuffisant pendant le checkout.
     * (Simule une race condition ou un panier non mis à jour)
     */
    public function test_checkout_fails_if_stock_becomes_insufficient(): void
    {
        $product = Article::factory()->create(['quantite' => 1, 'prix' => 50.00, 'est_visible' => true]);

        // Simuler un panier avec une quantité qui était valide au moment de l'ajout
        $cartData = [
            $product->id => [
                'name' => $product->name,
                'quantity' => 2, // Le panier pense qu'on peut en prendre 2
                'price' => $product->prix,
                'image_principale' => $product->image_principale
            ]
        ];
        session(['cart' => $cartData]);

        $checkoutData = [
            'customer_name' => 'Race Condition Test',
            'customer_email' => 'race@example.com',
            // ... autres champs ...
            'shipping_address_line1' => '123 Race St',
            'shipping_address_city' => 'Racetown',
            'shipping_address_postal_code' => '54321',
            'shipping_address_country' => 'Raceland',
        ];

        $response = $this->post(route('ecommerce.checkout.process'), $checkoutData);

        $response->assertRedirect(route('checkout.index')); // Doit rediriger vers la page de checkout
        $response->assertSessionHas('error'); // Doit avoir un message d'erreur
        $this->assertDatabaseMissing('orders', ['customer_email' => 'race@example.com']); // Aucune commande créée
        $product->refresh();
        $this->assertEquals(1, $product->quantite); // Le stock ne doit pas avoir changé
    }
}
