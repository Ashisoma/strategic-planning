<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class ActivityProgress extends Model{

    protected $table = "activity_progresses";

    protected $fillable = ['activity_id', 'date', 'prev_value', 'increment', 'note', 'added_by'];
    
}