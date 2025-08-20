<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
     public function vendas(){
        return $this->hasOne(Venda::class);
    }
}
