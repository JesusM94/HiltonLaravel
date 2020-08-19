<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelPedidosDetalle extends Model
{
    protected $fillable = ['id_compra','id_articulo','cantidad','precio_lista','precio_final','estado'];
    protected $table = 'tbl_pedidos_detalles';
}
