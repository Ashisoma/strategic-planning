<?php
namespace Controllers;

use Controllers\Utils\Utility;
use Models\ActivityProgress;

class ProgressController extends BaseController{

    public function __construct(){
        parent::__construct();
        $this->user = parent::getUser();
    }

    public function saveActivityProgress($progressData){
        $params = ['activity_id', 'date', 'increment', 'note'];
        try {
            $missing = Utility::checkMissingAttributes($progressData, $params);
            if (sizeof($missing) > 0) throw new \Exception("Missing attributes : " . json_encode($missing));
            $id = '';
            if(isset($progressData['id']) && $progressData['id'] != '') $id = $progressData['id'];
            $currentProgress = ActivityProgress::where('activity_id', $progressData['activity_id'])->sum('increment');
            if(($progressData['increment'] + $currentProgress) > 100) throw new \Exception("Progress value error : " . ($progressData['increment'] + $currentProgress));//TODO If progress is editable revisit.
            if($id != ''){
                $activityProgress = ActivityProgress::findOrFail($id);
                $activityProgress->date = $progressData['date'];
                $activityProgress->increment = $progressData['increment'];
                $activityProgress->note = $progressData['note'];
                $activityProgress->save();
            } else {
                $activityProgress = ActivityProgress::create([
                    'activity_id' => $progressData['activity_id'],
                    'date' => $progressData['date'],
                    'increment' => $progressData['increment'],
                    'note' => $progressData['note'],
                    'added_by' => $this->user->id
                ]);
            }
            return $activityProgress;
        } catch (\Throwable $th) {
            Utility::logError($th->getCode(), $th->getMessage());
            http_response_code(412);
            return null;
        }
    }

    public function getActivityProgresses($activityId){
        $progresses = ActivityProgress::where('activity_id', $activityId)->orderBy('date', 'asc')->get();
        return $progresses;
    }
}