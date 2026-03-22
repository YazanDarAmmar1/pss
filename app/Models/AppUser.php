<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class AppUser extends Authenticatable
{
    protected $guard = 'app';
    protected $table = 'app_users';

    protected $fillable = ['name', 'email', 'password', 'phone', 'country_id'];


}
