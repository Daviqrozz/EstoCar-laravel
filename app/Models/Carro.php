<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Carro extends Model

{
     /*Att:
    -Adicionar Id do usuario que criou o carro*/
    protected $fillable = [
        'ano',
        'cor',
        'marca',
        'preco',
        'status', //0->Vendido/1-Disponivel
        'modelo'
    ];
    use HasFactory;
     public function vendas(){
        return $this->hasOne(Venda::class);
    }
    public function usuario()
{
    return $this->belongsTo(User::class, 'usuario_id');
}
}
