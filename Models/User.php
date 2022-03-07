<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table = 'users';

    protected $fillable = ['name', "gender", 'email', 'mobile', 'password', 'operation_base', 'designation', 'active', "last_login"];

    protected $hidden = ['password'];

}
