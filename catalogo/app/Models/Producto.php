<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $primaryKey = 'idProducto';
    public $timestamps = false;
    ## relación a tabla marcas
    public function relMarca()
    {
        return $this->belongsTo(
                            '\App\Models\Marca',
                            'idMarca',
                            'idMarca'
                               );
    }

    ## relación a tabla categorias
    public function relCategoria()
    {
        return $this->belongsTo(
                            '\App\Models\Categoria',
                            'idCategoria',
                            'idCategoria'
                                );
    }
}
