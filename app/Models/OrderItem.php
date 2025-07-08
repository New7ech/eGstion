<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name', // Nom du produit au moment de la commande
        'price',        // Prix unitaire au moment de la commande
        'quantity',
        'total_price',  // quantity * price
        'product_sku',
        // 'product_options' // Si des options de produit sont nécessaires
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'quantity' => 'integer',
        // 'product_options' => 'json',
    ];

    /**
     * Obtient la commande à laquelle cet article appartient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Obtient le produit associé à cet article de commande.
     * Fait référence au modèle Article qui sert de produit.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        // Note: `product_id` dans la table `order_items` référence `id` dans la table `articles`.
        return $this->belongsTo(Article::class, 'product_id');
    }
}
