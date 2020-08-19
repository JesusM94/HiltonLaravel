<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelCompras extends Model
{
    protected $fillable = ['fecha', 'id_membresia','nombre','telefono','celular','nextel','email','estado'];
    protected $table = 'tbl_compras';
}
