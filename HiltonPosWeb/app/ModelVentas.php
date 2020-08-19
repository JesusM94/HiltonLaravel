<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelVentas extends Model
{
    protected $fillable = ['fecha','id_membresia','imp','observaciones','estado'];
    protected $table = 'tbl_ventas';
}
