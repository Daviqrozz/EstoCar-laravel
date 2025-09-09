<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Carro extends Model

{
    protected $fillable = [
        'ano',
        'cor',
        'marca',
        'preco',
        'status',
        'modelo'
    ];
    use HasFactory;
     public function vendas(){
        return $this->hasOne(Venda::class);
    }
}
