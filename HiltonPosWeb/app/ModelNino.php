<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelNino extends Model
{
    protected $fillable = ['nombre', 'estado'];
    protected $table = 'tbl_designers';
}
