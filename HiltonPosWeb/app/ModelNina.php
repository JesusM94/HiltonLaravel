<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelNina extends Model
{
    protected $fillable = ['nombre', 'estado'];
    protected $table = 'tbl_designers';
}
