<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CryptoUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'crypto_users'; // Asegúrate de que el nombre de la tabla sea correcto

    protected $primaryKey = 'id'; // Cambia la clave primaria si es necesario

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string, mixed>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function roles()
{
    return $this->belongsToMany(Role::class, 'crypto_user_roles');
}

public function hasRole($role)
{
    return $this->roles()->where('name', $role)->exists();
}

public function isAdmin()
{
    return $this->roles()->where('name', 'admin')->exists();
}
}
