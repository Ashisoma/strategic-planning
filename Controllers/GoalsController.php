<?php

namespace Controllers;

use Controllers\Utils\Utility;
use Models\Goal;
use Illuminate\Database\Capsule\Manager as DB;
use Models\ActivityPi;
use Models\Strategy;
use Models\User;

class GoalsController extends BaseController
{
    // private $user = null;
    public function __construct()
    {
        parent::__construct();      
        $this->user = parent::getUser();
    }

    public function saveGoalRequest($goalData)
    {
        $params = ['name', 'description', 'lead'];
        #create goal object
        #create objective
        #create strategy -----kinda useless!!!
        #create activities
        #create PIs
        DB::beginTransaction();
        try {
            $missing = Utility::checkMissingAttributes($goalData, $params);
            if (sizeof($missing) > 0) throw new \Exception('Missing attributes : ' . json_encode($missing));
            $id = '';
            if (isset($goalData['id'])) $id = trim($goalData['id']);
            if ($id != "") {
                $goal = Goal::findOrFail($id);
                $goal->name = $goalData['name'];
                $goal->description = $goalData['description'];
                $goal->lead = $goalData['lead'];
                $goal->save();
            } else {
                $goal = Goal::create([
                    "name" => $goalData['name'],
                    "description" => $goalData['description'],
                    "lead" => $goalData['lead'],
                ]);
                $objectives = $goalData['objectives'];
                foreach ($objectives as $objective) {
                    $objective = (array)$objective;
                    $objective['goal_id'] = $goal->id;
                    $objectivesController = new ObjectivesController();
                    $objectiveId = $objectivesController->saveObjective($objective);
                    throw_if($objectiveId == null, new \Exception('Unable to add objective.'));
                    $strategies = $objective['strategies'];
                    foreach ($strategies as $strategy) {
                        $strategy = (array) $strategy;
                        $strategy['objective_id'] = $objectiveId;
                        Strategy::create($strategy);
                    }
                    $activities = $objective['activities'];
                    foreach ($activities as $activity) {
                        $activity = (array) $activity;
                        $activity['objective_id'] = $objectiveId;
                        $activitiesController = new ActivitiesController();
                        $activityId = $activitiesController->saveActivity($activity);
                        throw_if($activityId == null, new \Exception('Unable to add activity.'));
                        $pis = $activity['pis'];
                        foreach ($pis as $pi) {
                            $pi = (array) $pi;
                            $pi["activity_id"] = $activityId;
                            ActivityPi::create($pi);
                        }
                    }
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(412);
        }
    }

    public function saveGoal($goalData)
    {
        $params = ['name', 'description', 'lead'];
        try{
            $missing = Utility::checkMissingAttributes($goalData, $params);
            if(sizeof($missing) > 0) throw new \Exception('Missing attributes: ' . json_encode($missing));
            $id = '';
            if(isset($goalData['id']) && $goalData['id'] != '') $id = $goalData['id'];
            if($id != ''){
                $goal = Goal::findOrFail($id);
                $goal->name = $goalData['name'];
                $goal->description = $goalData['description'];
                $goal->lead = $goalData['lead'];
                $goal->save();
            } else {
                Goal::create([
                    "name" => $goalData['name'],
                    "description" => $goalData['description'],
                    "lead" => $goalData['lead']
                ]);
            }
            echo json_encode($this->getGoals());
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(412);
        }
    }

    public function getGoals()
    {
        $goals = Goal::all();
        foreach ($goals as $goal) {
            $objectives = $goal->getObjectives();
            foreach ($objectives as $objective) {
                $strategies = $objective->getStrategies();
                $activities = $objective->getActivities();
                foreach ($activities as $activity) {
                    $activity['strategy'] = $activity->getStrategy();
                    $activity["progresses"] = $activity->getProgresses();
                    $activity['personResponsible'] = $activity->getPersonResponsible();
                }
                $objective['activities'] = $activities;
                $objective['strategies'] = $strategies;
                $lead = User::findOrFail($objective->lead);
                $objective['leadname'] = $lead->name;
            }
            $goal['objectives'] = $objectives;
        }
        return $goals;
    }
}
