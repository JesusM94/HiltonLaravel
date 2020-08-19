<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelGastos extends Model
{
    protected $fillable = ['fecha','descripcion','total','estado'];
    protected $table = 'tbl_gastos';
}
