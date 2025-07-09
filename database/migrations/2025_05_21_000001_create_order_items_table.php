<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            // Utiliser 'product_id' pour faire référence à la table 'articles' qui sert de table produits
            $table->foreignId('product_id')->constrained('articles')->onDelete('cascade');
            // Il est possible que le produit soit supprimé plus tard, donc on peut aussi utiliser ->onDelete('set null')
            // et stocker les informations essentielles du produit ici.
            // Pour cette version, on va supposer que les produits ne sont pas supprimés s'ils sont dans des commandes.

            $table->string('product_name'); // Stocker le nom au moment de la commande
            $table->decimal('price', 10, 2); // Stocker le prix au moment de la commande
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2); // quantity * price

            $table->string('product_sku')->nullable(); // Optionnel, pour référence
            // $table->json('product_options')->nullable(); // Si les produits ont des options (taille, couleur, etc.)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
