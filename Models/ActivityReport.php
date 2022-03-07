<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

class ActivityReport extends Model{

    protected $fillable = ['activity_id', 'user_id', 'completed_tasks', 'pending_tasks', 'recommendations', 'challenges',
        'lead_comment', 'start_date', 'end_date'];
}
