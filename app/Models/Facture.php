<?php

namespace App\Models;

use App\Models\Article;
use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facture extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $table = 'factures';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_nom',
        'client_prenom',
        'client_adresse',
        'client_telephone',
        'client_email',
        'numero', // Ajouté par une migration ultérieure, correct ici
        'date_facture',
        'montant_ht',
        'tva',
        'montant_ttc',
        'statut_paiement',
        'date_paiement',
        'mode_paiement',
        // 'quantity', // Appartient à la table pivot article_facture
        // 'prix_unitaire', // Appartient à la table pivot article_facture
        // 'date', // Trop vague, date_facture et date_paiement sont spécifiques
    ];

    /**
     * Les articles associés à cette facture.
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_facture')
                    ->withPivot('quantite', 'prix_unitaire')
                    ->withTimestamps();
    }

    /**
     * Filtre les factures en fonction des critères de recherche.
     * Ce scope est destiné à remplacer l'ancien scope 'search' et 'filter'.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApplyFilters($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('numero', 'like', "%{$search}%")
                  ->orWhere('client_nom', 'like', "%{$search}%")
                  ->orWhere('client_email', 'like', "%{$search}%")
                  ->orWhere('statut_paiement', 'like', "%{$search}%")
                  ->orWhere('id', 'like', "%{$search}%"); // Recherche par ID peut être utile
            });
        });

        // TODO: Ajouter d'autres filtres si nécessaire (par date, montant, etc.)
        // $query->when($filters['date_from'] ?? null, function ($query, $date_from) {
        //     $query->where('date_facture', '>=', $date_from);
        // });
        // $query->when($filters['date_to'] ?? null, function ($query, $date_to) {
        //     $query->where('date_facture', '<=', $date_to);
        // });

        return $query;
    }
}
