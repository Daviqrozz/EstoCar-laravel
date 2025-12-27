<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{

    protected $fillable = [
        'nome'
    ];

    public function registros()
    {
        return $this->hasMany(OrdemServicoRegistro::class);
    }
}
