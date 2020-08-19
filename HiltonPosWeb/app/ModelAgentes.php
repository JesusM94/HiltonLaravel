<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelAgentes extends Model
{
    protected $fillable = ['nombre_usuario', 'contrasena', 'nombre', 'apellido_paterno', 'apellido_materno', 'telefono_local', 'telefono_celular', 'nextel', 'email', 'fecha_alta', 'estado'];
    protected $table = 'tbl_agentes';
}
