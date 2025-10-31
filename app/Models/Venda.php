<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;
    protected $fillable = [
        'cliente_id',
        'usuario_id',
        'carro_id',
        'data_venda',
        'decimal',
        'valor_venda',
        'status'//0->indisponivel 1->disponvel 
        
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
