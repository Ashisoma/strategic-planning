<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

class PIAssignment extends Model{

    protected $table = "pi_assignments";

    protected $fillable = ['activity_id', 'user_id'];


}
