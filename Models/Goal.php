<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model {

    protected $fillable = ['name', 'description', 'lead'];

    public function getObjectives(){
        $objectives = Objective::where("goal_id", $this->id)->get();
        return $objectives;
    }

    public function getLead(){
        return User::find($this->lead);
    }
}