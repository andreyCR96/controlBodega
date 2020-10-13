<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_Producto';
    protected $fillable = ['codigo', 'nombre', 'unidad', 'ubicacion','descripcion','id_Lote','created_at','updated_at'];
}
