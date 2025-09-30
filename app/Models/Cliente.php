<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    /*Att:
    -Adicionar Id do usuario que criou o cliente*/
        protected $fillable = [
        'nome',
        'cpf',
        'email',
        'telefone',
        'endereco',
    ];
    
    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }
    public function usuario()
{
    return $this->belongsTo(User::class, 'usuario_id');
}
}
