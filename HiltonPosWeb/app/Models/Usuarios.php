<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Authenticatable
{
	use Notifiable;
	
    protected $table = 'tbl_membresias';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'user_name', 'email', 'password'];
}
