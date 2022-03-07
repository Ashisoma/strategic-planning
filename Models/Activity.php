<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;



class Activity extends Model{


    protected $fillable = ['user_id','name', 'description', 'objective_id', "strategy_id", "expected_start_date", "due_date", "date_started", "date_completed", "weight", "status"];

    public function getPis(){
        $pis = ActivityPi::where('activity_id', $this->id)->get();
        return $pis;
    }

    public function getStrategy() {
        return Strategy::find($this->strategy_id);
    }

    public function getProgresses(){
        return ActivityProgress::where('activity_id', $this->id)->orderBy('date', 'asc')->get();
    }

    public function getPersonResponsible(){
        return User::find($this->user_id);
    }
}