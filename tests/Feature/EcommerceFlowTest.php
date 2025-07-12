<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Article;
use App\Models\Categorie;

class EcommerceFlowTest extends TestCase
{
    use RefreshDatabase; // Utiliser RefreshDatabase pour s'assurer que chaque test est isolé

    /**
     * Teste l'affichage de la page d'accueil e-commerce.
     *
     * @return void
     */
    public function test_ecommerce_home_page_loads_correctly(): void
    {
        Article::factory()->count(3)->create(['est_visible' => true]);

        $response = $this->get(route('ecommerce.home'));

        $response->assertStatus(200);
        $response->assertSeeText('Nos Articles Étoiles'); // Vérifier un texte clé mis à jour
    }

    /**
     * Teste l'affichage d'une page article détaillée.
     *
     * @return void
     */
    public function test_article_detail_page_loads_correctly(): void
    {
        $article = Article::factory()->create(['est_visible' => true, 'slug' => 'test-article-pour-detail']);

        // Utilise la nouvelle route pour les articles
        $response = $this->get(route('ecommerce.articles.show', $article->slug));

        $response->assertStatus(200);
        $response->assertSeeText($article->name);
        $response->assertSeeText('Ajouter au panier');
    }

    /**
     * Teste l'ajout d'un article au panier.
     *
     * @return void
     */
    public function test_article_can_be_added_to_cart(): void
    {
        $article = Article::factory()->create(['est_visible' => true, 'quantite' => 10]);

        // Utilise la nouvelle route et le nouveau nom de champ
        $response = $this->post(route('ecommerce.panier.ajouter'), [
            'article_id' => $article->id,
            'quantity' => 1,
        ]);

        // Le PanierController devrait rediriger vers la page du panier
        $response->assertRedirect(route('ecommerce.panier.index'));

        // La logique du panier en session dépend de l'implémentation de PanierController.
        // On va supposer qu'il crée une session 'panier'.
        // Le test suivant vérifie l'affichage, ce qui est un bon indicateur.
        $this->get(route('ecommerce.panier.index'))
            ->assertStatus(200)
            ->assertSeeText($article->name);
    }

    /**
     * Teste que la page de checkout se charge correctement avec des articles dans le panier.
     *
     * @return void
     */
    public function test_checkout_page_loads_with_items_in_cart(): void
    {
        $article = Article::factory()->create(['est_visible' => true, 'quantite' => 2]);

        // Simuler l'ajout au panier
        $this->post(route('ecommerce.panier.ajouter'), ['article_id' => $article->id, 'quantity' => 1]);

        $response = $this->get(route('ecommerce.commande.checkout'));

        $response->assertStatus(200);
        $response->assertSeeText('Finalisation de la Commande');
        $response->assertSeeText($article->name);
    }

    /**
     * Teste que le processus de commande fonctionne (simulation).
     * Ce test doit être adapté à l'implémentation réelle de CommandeController.
     *
     * @return void
     */
    public function test_checkout_process_redirects_to_confirmation(): void
    {
        $article = Article::factory()->create(['quantite' => 5, 'prix' => 50.00]);

        // Simuler un panier dans la session, car la logique de création de commande en dépend
        session()->put('panier', [
            $article->id => [
                'name' => $article->name,
                'quantity' => 1,
                'price' => $article->prix,
                'image_url' => $article->image_url,
                'slug' => $article->slug
            ]
        ]);

        $checkoutData = [
            'nom_complet' => 'John Doe',
            'email' => 'john.doe@example.com',
            'adresse_livraison' => '123 Rue du Test',
            'ville' => 'Testville',
            'code_postal' => '12345',
            'pays' => 'France',
            // Les détails de paiement sont simulés
            'payment_details' => ['card_name' => 'John Doe', 'card_number' => '0000111122223333', 'expiry_date' => '12/25', 'cvc' => '123'],
            'total_commande' => '50.00'
        ];

        // Utilise la route de traitement de la commande
        $response = $this->post(route('ecommerce.commande.process'), $checkoutData);

        // Le CommandeController redirige vers la page de confirmation avec un ID de commande simulé
        $response->assertRedirect(); // Vérifie qu'il y a une redirection
        $response->assertSessionHas('succes', 'Votre commande a été traitée avec succès ! (simulé)');

        // On ne peut pas vérifier la redirection vers la route de confirmation avec un ID aléatoire facilement,
        // mais on peut vérifier que le panier a été vidé.
        $this->assertEmpty(session('panier'));
    }
}
