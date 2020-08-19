<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelVentasDetalle extends Model
{
    protected $fillable = ['id_vta','id_art','id_cprdet','cant','costo','estado'];
    protected $table = 'tbl_ventas_detalles';
}
