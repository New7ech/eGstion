<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'billing_address',
        'order_number',
        'total_amount',
        'subtotal_amount',
        'tax_amount',
        'shipping_cost',
        'status',
        'payment_method',
        'payment_status',
        'shipping_method',
        'notes',
        // 'user_id' // A ajouter si la liaison avec les utilisateurs enregistrés est implémentée
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'subtotal_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'shipping_address' => 'json', // Ou garder en tant que texte si la structure n'est pas fixe
        'billing_address' => 'json',  // Ou garder en tant que texte
    ];

    /**
     * Générer un numéro de commande unique avant de créer la commande.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = static::generateOrderNumber();
            }
        });
    }

    /**
     * Génère un numéro de commande unique.
     * Exemple: ORD-YYYYMMDD-XXXXXX
     *
     * @return string
     */
    public static function generateOrderNumber(): string
    {
        do {
            $number = 'ORD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));
        } while (static::where('order_number', $number)->exists()); // Vérifie l'unicité

        return $number;
    }

    /**
     * Obtient les articles de cette commande.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Si la liaison avec les utilisateurs enregistrés est implémentée.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }

    /**
     * Calcule le sous-total de la commande basé sur les articles.
     * Utile si non stocké directement ou pour vérification.
     */
    public function calculateSubtotal(): float
    {
        return $this->items->sum(function($item) {
            return $item->price * $item->quantity;
        });
    }
}
