<?php

namespace Controllers;

use Models\User;
use Models\Activity;
use Models\ActivityPi;
use Models\PIAssignment;
use Models\ActivityReport;
use Controllers\Utils\Utility;
use Controllers\BaseController;

class ActivitiesController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->user = parent::getUser();
    }

    public function saveActivity($activityData)
    {
        $params = ['name', 'user_id', 'description', 'objective_id', 'strategy_id', "status",  "expected_start_date", "due_date", "date_started", "date_completed", "weight", "completion_note"];
        try {
            $missing = Utility::checkMissingAttributes($activityData, $params);
            if (sizeof($missing) > 0) throw new \Exception("Missing attributes : " . json_encode($missing));
            $id = '';
            if (isset($activityData['id'])) $id = $activityData['id'];
            if ($id != '') {
                $activity = Activity::findOrFail($id);
                $activity->name = $activityData['name'];
                $activity->description = $activityData['description'];
                $activity->user_id = $activityData['user_id'];
                $activity->objective_id = $activityData['objective_id'];
                $activity->status = $activityData['status'];
                $activity->expected_start_date = $activityData['expected_start_date'];
                $activity->due_date = $activityData['due_date'];
                $activity->date_started = $activityData['date_started'] == '' ? null : $activityData['date_started'];
                $activity->date_completed = $activityData['date_completed'] == '' ? null : $activityData['date_completed'];
                $activity->weight = $activityData['weight'];
                $activity->completion_note = $activityData['completion_note'];
                $activity->save();
            } else {
                $activity = Activity::create([
                    "name" => $activityData['name'],
                    "description" => $activityData['description'],
                    "strategy_id" => $activityData['strategy_id'],
                    "user_id" => $activityData['user_id'],
                    "objective_id" => $activityData['objective_id'],
                    "status" => $activityData['status'],
                    "expected_start_date" => $activityData['expected_start_date'],
                    "due_date" => $activityData['due_date'],
                    "date_started" => $activityData['date_started'] == '' ? null : $activityData['date_started'],
                    "date_completed" => $activityData['date_completed'] == '' ? null : $activityData['date_completed'],
                    "weight" => $activityData['weight'],
                    "completion_note" => $activityData['completion_note'],
                    "created_by" => $this->user->id,
                ]);
            }
            return $activity->id;
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            // http_response_code(412);
            return null;
        }
    }

    public function savePi($piData)
    {
        $params = ['name', 'activity_id'];
        try {
            $missing = Utility::checkMissingAttributes($piData, $params);
            if (sizeof($missing) > 0) throw new \Exception("Missing attributes : " . json_encode($missing));
            $id = '';

            if (isset($piData['id'])) $id = $piData['id'];
            if ($id == '') {
                $activityPi = ActivityPi::create([
                    "name" => $piData['name'],
                    "activity_id" => $piData['activity_id']
                ]);
            } else {
                $activityPi = ActivityPi::findOrFail($id);
                $activityPi->name = $piData['name'];
                $activityPi->save();
            }
        } catch (\Throwable $th) {
            Utility::logError($th->getCode, $th->getMessage());
            http_response_code(412);
        }
    }

    public function getMyActivities() //TODO: Implement filter for activities here
    {
        $activities = Activity::all();
        foreach ($activities as $activity) {
            $activity['pis'] = $activity->getPis();
        }
        return $activities;
    }

    public function getAllActivities(){
        $activities = Activity::all();
        foreach ($activities as $activity) {
            $activity['pis'] = $activity->getPis();
        }
        return $activities;
    }

    public function saveActivityReport($reportData)
    {
        $params = ['activity_id', 'completed_tasks', 'pending_tasks', 'recommendations', 'challenges',
        'lead_comment', 'start_date', 'end_date'];
        try {
            $missing = Utility::checkMissingAttributes($reportData, $params);
            if(sizeof($missing) > 0) throw new \Exception("Missing attributes : " . json_encode($missing));
            $id = '';
            if(isset($reportData['id']) && $reportData['id'] != '') $id = $reportData['id'];
            if($id != ''){
                $report = Activity::findOrFail($id);
                $report->activity_id = $reportData['activity_id'];
                $report->completed_tasks = $reportData['completed_tasks'];
                $report->pending_tasks = $reportData['pending_tasks'];
                $report->pending_tasks = $reportData['pending_tasks'];
                $report->recommendations = $reportData['recommendations'];
                $report->challenges = $reportData['challenges'];
                $report->lead_comment = $reportData['lead_comment'];
                $report->start_date = $reportData['start_date'];
                $report->end_date = $reportData['end_date'];
                $report->save();
            } else {
                $report = ActivityReport::create([
                    'activity_id' => $reportData['activity_id'],
                    'user_id' => $this->user->id,
                    'completed_tasks' => $reportData['completed_tasks'],
                    'pending_tasks' => $reportData['pending_tasks'],
                    'recommendations' => $reportData['recommendations'],
                    'challenges' => $reportData['challenges'],
                    'lead_comment' => $reportData['lead_comment'],
                    'start_date' => $reportData['start_date'],
                    'end_date' => $reportData['end_date'],
                ]);
            }
            return $report;
        } catch(\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(412);
            return null;
        }
    }

    public function getActivitiesReports() {
        try{
            $reports = ActivityReport::all();//TODO filter out later
            foreach($reports as $report){
                $user = User::findOrFail($report->user_id);
                $activity = Activity::findOrFail($report->activity_id);
                $report['user'] = $user;
                $report['activity'] = $activity;
            }
            return $reports;
        } catch (\Throwable $th){
            Utility::logError($th->getCode(), $th->getMessage());
            return[];
        }
    }
}
