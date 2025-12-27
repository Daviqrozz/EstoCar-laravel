<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    protected $table = 'ordens_servico';
    
    protected $fillable = [
        'carro_id',
        'cliente_id',
        'usuario_id',
        'descricao',
        'status',
        'data_abertura',
        'valor_total',
    ];

    public function registros()
    {
        return $this->hasMany(OrdemServicoRegistro::class);
    }

    public function carro()
    {
        return $this->belongsTo(Carro::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

   public function user(){
        return $this->belongsTo(User::class,'usuario_id'); 
    }
}

