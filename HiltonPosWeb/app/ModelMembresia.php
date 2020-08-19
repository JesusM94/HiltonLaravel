<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelMembresia extends Model
{
    protected $fillable = ['clase', 'nombre_usuario','contrasena','nombre','apellido_paterno','apellido_materno','empresa','rfc','domicilio','telefono_local','telefono_celular','nextel','email','fecha_alta','antiguedad','vencimiento','estado'];
    protected $table = 'tbl_membresias';
}
