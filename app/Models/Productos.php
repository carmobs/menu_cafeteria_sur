<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $fillable = ['nombre', 'descripcion', 'precio', 'imagen_url', 'categoria_id', 'tipo_producto', 'disponible', 'fecha_agregado', 'fecha_actualizacion'];
}
