<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
   public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function carro(){
        return $this->belongsTo(Carro::class);
    }

    public function usuario(){
        return $this->belongsTo(User::class); 
    }
}
