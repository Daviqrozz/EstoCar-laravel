<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdemServicoRegistro extends Model
{
    protected $table = 'ordens_servico_registros';
    protected $fillable = [
        'ordem_servico_id',
        'servico_id',
    ];

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }

    public function ordemServico()
    {
        return $this->belongsTo(OrdemServico::class);
    }
}
