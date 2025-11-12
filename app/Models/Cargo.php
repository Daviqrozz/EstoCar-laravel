<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $fillable = ['nome']; // caso precise criar cargos via seeder

    public function usuarios()
    {
        return $this->belongsToMany(
            User::class,
            'cargo_usuario',
            'cargo_id',
            'user_id'
        )->withTimestamps();
    }
}
