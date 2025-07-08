<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fournisseur;
use App\Models\Emplacement;
use App\Models\User;
use App\Models\Facture;

class Article extends Model
{
    use HasFactory;

    /**
     * La table associée au modèle.
     *
     * @var string
     */
    protected $table = 'articles';

    /**
     * La clé primaire associée à la table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'est_visible',
        'description',
        'sku',
        'image_principale',
        'prix',
        'prix_promotionnel',
        'quantite',
        'statut',
        'poids',
        'category_id',
        'fournisseur_id',
        'emplacement_id',
        'created_by'
    ];

    /**
     * Les attributs qui doivent être castés vers des types natifs.
     *
     * @var array
     */
    protected $casts = [
        'prix' => 'decimal:2',
        'prix_promotionnel' => 'decimal:2',
        'poids' => 'decimal:3',
        'est_visible' => 'boolean',
        'quantite' => 'integer',
    ];

    /**
     * Obtient l'URL complète de l'image principale de l'article.
     *
     * @return string|null
     */
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image_principale) {
            // Vérifie si le fichier existe dans le disque public
            // Note: Storage::disk('public')->exists() est plus sûr mais peut être plus lourd.
            // Pour une simple URL, on peut se contenter de construire le chemin.
            // Si le fichier est stocké avec un chemin complet (improbable avec l'upload), ajuster ici.
            if (str_starts_with($this->image_principale, 'http://') || str_starts_with($this->image_principale, 'https://')) {
                return $this->image_principale; // C'est déjà une URL complète
            }
            // S'assurer que storage:link a été exécuté
            return asset('storage/' . $this->image_principale);
        }
        // Retourner une image par défaut ou null si aucune image n'est définie
        // return asset('images/default_article_image.png'); // Exemple d'image par défaut
        return null;
    }

    /**
     * Obtient les factures associées à l'article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function factures(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Facture::class, 'article_facture')
                    ->withPivot('quantite', 'prix_unitaire')
                    ->withTimestamps();
    }

    /**
     * Filtre la requête pour inclure uniquement les articles correspondant à un terme de recherche dans le nom ou la description.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query La requête Eloquent.
     * @param  string  $searchTerm Le terme de recherche.
     * @return \Illuminate\Database\Eloquent\Builder La requête Eloquent modifiée.
     */
    public function scopeSearchByText(\Illuminate\Database\Eloquent\Builder $query, string $searchTerm): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where(function($q) use ($searchTerm) {
            $q->where('name', 'like', "%{$searchTerm}%")
              ->orWhere('description', 'like', "%{$searchTerm}%");
        });
    }

    /**
     * Obtient la catégorie à laquelle l'article appartient.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categorie(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Categorie::class, 'category_id');
    }

    /**
     * Obtient le fournisseur de l'article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fournisseur(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Fournisseur::class, 'fournisseur_id');
    }

    /**
     * Obtient l'emplacement où l'article est stocké.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function emplacement(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Emplacement::class, 'emplacement_id');
    }

    /**
     * Obtient l'utilisateur qui a créé l'article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
