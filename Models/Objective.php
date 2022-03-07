<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

class Objective extends Model{


    protected $fillable = ['name', 'description', 'goal_id', 'lead', 'created_by'];


    public function getStrategies() {
        $strategies = Strategy::where('objective_id', $this->id)->get();
        return $strategies;
    }

    public function getActivities(){
        $activities = Activity::where('objective_id', $this->id)->get();
        foreach ($activities as $activity){
            $activity['pis'] = $activity->getPis();
        }
        return $activities;
    }

    public function getLead(){
        return User::find($this->lead);
    }
}