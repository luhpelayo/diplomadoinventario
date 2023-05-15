<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * This class defines the atributes of product and its relation with
 * other models
 */
class Producto extends Model
{
    use HasFactory;
    protected $table="productos";
    protected $guarded=['id','created_at','updated_at'];

    public function categoria(){
        return $this->belongsTo('App\Models\Categoria', 'idCategoria');
    }
    
    public function salidas(){

        return $this->belongsToMany(Producto::class)->withPivot('cantidad'); 

    }
    public function autos(){

        return $this->belongsToMany('App\Models\Auto') ;  
    }
  
}
