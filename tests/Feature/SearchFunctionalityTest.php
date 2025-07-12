<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Article;
use App\Models\User;

class SearchFunctionalityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function la_page_catalogue_affiche_les_articles_visibles()
    {
        Article::factory()->create(['name' => 'Article Visible', 'est_visible' => true]);
        Article::factory()->create(['name' => 'Article Cache', 'est_visible' => false]);

        $response = $this->get(route('ecommerce.articles.index'));

        $response->assertStatus(200);
        $response->assertSee('Article Visible');
        $response->assertDontSee('Article Cache');
    }

    /** @test */
    public function la_recherche_filtre_les_articles_par_nom()
    {
        Article::factory()->create(['name' => 'Produit Test Un', 'est_visible' => true]);
        Article::factory()->create(['name' => 'Autre Produit', 'est_visible' => true]);

        $response = $this->get(route('ecommerce.articles.index', ['search' => 'Test Un']));

        $response->assertStatus(200);
        $response->assertSee('Produit Test Un');
        $response->assertDontSee('Autre Produit');
    }

    /** @test */
    public function la_recherche_est_insensible_a_la_casse()
    {
        Article::factory()->create(['name' => 'Produit en Majuscules', 'est_visible' => true]);

        $response = $this->get(route('ecommerce.articles.index', ['search' => 'produit en majuscules']));

        $response->assertStatus(200);
        $response->assertSee('Produit en Majuscules');
    }

    /** @test */
    public function la_recherche_renvoie_un_message_si_aucun_resultat()
    {
        $response = $this->get(route('ecommerce.articles.index', ['search' => 'inconnu']));

        $response->assertStatus(200);
        $response->assertSee('Aucun article ne correspond à votre recherche.');
    }

    /** @test */
    public function la_pagination_fonctionne_sur_les_resultats_de_recherche()
    {
        // Crée 15 articles qui correspondent à la recherche
        for ($i = 1; $i <= 15; $i++) {
            Article::factory()->create(['name' => "Article Cherchable {$i}", 'est_visible' => true]);
        }
        // Crée un article qui ne correspond pas
        Article::factory()->create(['name' => 'Non Cherchable', 'est_visible' => true]);

        // Accède à la première page
        $response = $this->get(route('ecommerce.articles.index', ['search' => 'Cherchable']));
        $response->assertStatus(200);
        $response->assertSee('Article Cherchable 1');
        $response->assertDontSee('Article Cherchable 13'); // Par défaut, 12 par page

        // Accède à la deuxième page
        $responsePage2 = $this->get(route('ecommerce.articles.index', ['search' => 'Cherchable', 'page' => 2]));
        $responsePage2->assertStatus(200);
        $responsePage2->assertSee('Article Cherchable 13');
        $responsePage2->assertDontSee('Article Cherchable 1');
    }
}
