<?php
namespace Controllers;

use Controllers\Utils\Utility;
use Models\Activity;
use Models\Objective;
use Models\Strategy;

class ObjectivesController extends BaseController{

    public function __construct(){
        parent::__construct();
        $this->user = parent::getUser();
    }

    public function saveObjective($objectiveData){
        $params = ['name', 'description', 'goal_id', 'lead'];
        $missing = Utility::checkMissingAttributes($objectiveData, $params);
        try {
            if(sizeof($missing) > 0) throw new \Exception("Missing attributes : " . json_encode($missing), 1);
            $id = "";
            if(isset($objectiveData['id'])) $id = trim($objectiveData['id']);
            if($id != ""){
                $objective = Objective::findOrFail($id);
                $objective->name = $objectiveData['name'];
                $objective->description = $objectiveData['description'];
                $objective->lead = $objectiveData['lead'];
                $objective->save();
            } else {
                $objectiveData['created_by'] = $this->user->id;
                $objective = Objective::create($objectiveData);
            }
            return $objective->id;
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            return null;
            // http_response_code(412);
        }
    }

    public function getObjectives(){
        return Objective::all();
    }

    public function saveStrategy($strategyData){
        $params = ['name', 'objective_id'];
        try{
            $missing = Utility::checkMissingAttributes($strategyData, $params);
            if (sizeof($missing) > 0) throw new \Exception("Missing attributes : " . json_encode($missing));
            $id = '';
            if(isset($strategyData['id'])) $id = $strategyData['id'];
            if($id != ''){
                $strategy = Strategy::findOrFail($id);
                $strategy->name = $strategyData['name'];
                $strategy->save();
            } else {
                $strategy = Strategy::create([
                    "name" => $strategyData['name'],
                    "objective_id" => $strategyData['objective_id']
                ]);
            }
            return $strategy->id;
        } catch(\Throwable $th){
            Utility::logError($th->getCode(), $th->getMessage());
            // http_response_code(412);
            return null;
        }
    }

    public function getObjectiveActivities($id){
        try {
            $objective = Objective::findOrFail($id);
            $activities =  $objective->getActivities();
            foreach($activities as $activity) {
                $activity["strategy"] = $activity->getStrategy();
                $activity["progresses"] = $activity->getProgresses();
            }
            return $activities;
        } catch (\Throwable $th) {
            Utility::logError($th->getCode, $th->getMessage());
            return [];
        }
    }

    public function getObjectiveStrategies($id){
        try {
            $objective = Objective::findOrFail($id);
            return $objective->getStrategies();
        } catch (\Throwable $th) {
            Utility::logError($th->getCode, $th->getMessage());
            return [];
        }
    }

    public function getObjectiveLead($id){
        try {
            $objective = Objective::findOrFail($id);
            return $objective->getLead();
        } catch (\Throwable $th) {
            Utility::logError($th->getCode, $th->getMessage());
            return null;
        }
    }
}