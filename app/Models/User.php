<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
        ];
    }
    public function cargos()
    {
        return $this->belongsToMany(
            Cargo::class,
            'cargo_usuario',   // nome da tabela pivot
            'user_id',      // FK para users
            'cargo_id'         // FK para cargos
        )->withTimestamps();
    }
    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }

    public function carros()
    {
        return $this->HasMany(Carro::class);
    }

    public function clientes()
    {
        return $this->HasMany(Cliente::class);
    }
}
