<?php

namespace App;
//we need some guard for admins
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class admin extends Authenticatable // Model
{
    //this all process use only for admin login 
    use Notifiable;
    protected $guard = 'admin';
    protected $fillable = ['name','type','contact','email','password','image','status','create_at','updated_at',];
    protected $hidden = ['password','remember_token',]; 
    //add guard for admin at auth.php
}
 