<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelIndex extends Model
{
    protected $fillable = ['id_perfume','precio', 'estado'];
    protected $table = 'tbl_especiales';
}
