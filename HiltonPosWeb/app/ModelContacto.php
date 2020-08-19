<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelContacto extends Model
{
    protected $fillable = ['fecha', 'nombre','email','comentario','estado'];
    protected $table = 'tbl_comentarios';
}
