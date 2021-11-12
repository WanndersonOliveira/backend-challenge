<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedProd extends Model
{
    //use HasFactory;
    protected $table = 'ped_prod';
    
    public $timestamps = false;

    public function pedido(){
    	return $this->belongsTo('Pedido');
    }

    public function produto(){
    	return $this->belongsTo('Produto');
    }
}
