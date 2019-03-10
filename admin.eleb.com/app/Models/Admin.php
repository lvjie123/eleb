<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    //
    protected $fillable = ['name','password','email','remember_token','old_password','new_password','new_password_confirmation'];
    use HasRoles ;
    protected  $guard_name = 'web' ;
}
