<?php


namespace Controllers;


use Controllers\Utils\Utility;
use Illuminate\Database\Capsule\Manager as DB;

class ReportsController  extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->user = parent::getUser();
    }

    public function getActivityReports(){
        $query = "SELECT A.*, B.name AS 'userName', B.email AS 'email', C.name AS 'activityName', C.description AS 'activityDesc' FROM activity_reports A LEFT JOIN users B ON A.user_id = B.id LEFT JOIN activities C ON A.activity_id = C.id";
        $reports = DB::select($query);
        $fileName = "activity_report_" . time() .".xlsx";
        $headers = ['activityName', 'activityDesc','time_period', 'completed tasks', 'pending tasks', 'recommendations', 'challenges', 'lead comment', 'username', 'email' ];
        $attributes = ['activityName', 'activityDesc', 'time_period', 'completed_tasks', 'pending_tasks', 'recommendations', 'challenges', 'lead_comment', 'userName', 'email' ];
        $reportData = [];
        foreach ($reports as $report) {
            $datum = array();
            $datum['activityName'] = $report->activityName;
            $datum['activityDesc'] = $report->activityDesc;
            $datum['time_period'] = $report->start_date .'-' .$report->endDate;
            $datum['completed_tasks'] = $report->completed_tasks;
            $datum['pending_tasks'] = $report->pending_tasks;
            $datum['recommendations'] = $report->recommendations;
            $datum['lead_comment'] = $report->lead_comment;
            $datum['userName'] = $report->userName;
            $datum['email'] = $report->email;
            array_push($reportData, $datum);
        }
        Utility::buildExcel($fileName, $headers, $attributes, $reportData);
    }

}