<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

#Progress Indicators
class ActivityPi extends Model{

    protected $table = "activity_pis";

    protected $fillable = ['name', 'activity_id'];

}