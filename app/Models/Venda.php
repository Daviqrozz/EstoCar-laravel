<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = [
        'cliente_id',
        'usuario_id',
        'carro_id',
        'data_venda',
        'decimal',
        'valor_venda',
        'status'
    ];

   public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function carro(){
        return $this->belongsTo(Carro::class);
    }

    public function user(){
        return $this->belongsTo(User::class); 
    }
}
