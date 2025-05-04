<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false; // Deshabilitar marcas de tiempo

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen_url',
        'categoria_id',
        'tipo_producto',
        'disponible',
    ];

    protected $casts = [
        'tipo_producto' => 'string',
        'disponible' => 'boolean',
        'fecha_agregado' => 'datetime',
        'fecha_actualizacion' => 'datetime',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id');
    }
}
