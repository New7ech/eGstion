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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Pour les clients invités, nous stockons leurs informations directement ici.
            // Si la gestion des utilisateurs enregistrés est ajoutée plus tard, on pourrait ajouter un user_id nullable.
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone')->nullable();
            $table->text('shipping_address');
            $table->text('billing_address')->nullable(); // Optionnel, si différent de l'adresse de livraison

            $table->string('order_number')->unique(); // Numéro de commande unique
            $table->decimal('total_amount', 10, 2);
            $table->decimal('subtotal_amount', 10, 2)->nullable();
            $table->decimal('tax_amount', 10, 2)->nullable();
            $table->decimal('shipping_cost', 10, 2)->default(0);

            $table->string('status', 50)->default('pending'); // Ex: pending, processing, shipped, delivered, cancelled
            $table->string('payment_method')->default('cash_on_delivery');
            $table->string('payment_status', 50)->default('pending'); // Ex: pending, paid, failed

            $table->string('shipping_method')->nullable();
            $table->text('notes')->nullable(); // Notes du client ou administratives

            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
