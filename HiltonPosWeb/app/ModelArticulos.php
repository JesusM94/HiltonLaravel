<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelArticulos extends Model
{
    protected $fillable = ['id_designer','nombre','sexo','tipo','contenido','presentacion','precio_a','precio_b','precio_c','precio_p','descripcion','existencia','estante','codigo','codigoa1','codigoa2','codigoa3','codigoa4','codigoa5','fecha_alta', 'estado'];
    protected $table = 'tbl_perfumes';
}
