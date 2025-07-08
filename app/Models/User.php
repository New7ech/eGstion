<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Role;
use App\Models\Notification;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // 'role_id', // Supprimé pour se fier entièrement à Spatie pour la gestion des rôles
        'photo',
        'phone',
        'address',
        'birthdate',
        'locale',
        'currency',
        'status',
        'created_by',
        'updated_by',
        'last_login_at',
        'two_factor_secret',
        'two_factor_enabled',
        'last_action',
        'preferences',
        'is_admin', // Ce champ pourrait être géré par un rôle 'admin' via Spatie également
        'module_access', // Pourrait être géré par des permissions Spatie
        'notifications_enabled',
        'email_verified_at',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret', // Devrait probablement être caché
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_login_at' => 'datetime',
            'birthdate' => 'date',
            'two_factor_enabled' => 'boolean',
            'notifications_enabled' => 'boolean',
            'is_admin' => 'boolean', // Si conservé
            'module_access' => 'array', // Si c'est une liste de modules sous forme JSON
            'preferences' => 'array', // Si c'est du JSON
        ];
    }

    // La relation role() est commentée/supprimée car Spatie gère les rôles via le trait HasRoles.
    // public function role()
    // {
    //     return $this->belongsTo(Role::class); // Assurez-vous que Role::class est le bon modèle si vous le réactivez.
    // }

}
