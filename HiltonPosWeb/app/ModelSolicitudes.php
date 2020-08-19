<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelSolicitudes extends Model
{
    protected $fillable = ['id_usuario','fecha', 'estado'];
    protected $table = 'tbl_solicitudes';
}
