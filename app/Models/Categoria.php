<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * This class defines the atributes of category
 */
class Categoria extends Model
{
    use HasFactory;
    protected $table="categorias";
    protected $fillable=['nombre'];

    public function producto(){
        return $this->hasMany('App\Models\Producto');
    }
}
