<?php

use Controllers\GoalsController;
use Controllers\UsersController;
use Controllers\ProgressController;
use Controllers\ActivitiesController;
use Controllers\ObjectivesController;
use Controllers\Utils\Utility;

require __DIR__ . '/vendor/autoload.php';

$router = new \Bramus\Router\Router();

// Custom 404 Handler
$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    $notFound = file_get_contents("404.html");
    echo $notFound;
});

$router->post("/save_goal_request", function(){
    $rawdata = file_get_contents("php://input");
    $goalData = (array)json_decode($rawdata);
    // \Controllers\Utils\Utility::logError(0, json_encode($rawdata));
    $controller = new GoalsController();
    $controller->saveGoalRequest($goalData);
});
$router->post("/save_goal", function(){
    $controller = new GoalsController();
    $controller->saveGoal($_POST);
});
$router->get("/goals", function(){
    $controller = new GoalsController();
    echo json_encode($controller->getGoals());
});

$router->get("/objective_data/{objectiveId}", function($objectiveId){
    $controller = new ObjectivesController();
    $data['activities'] = $controller->getObjectiveActivities($objectiveId);
    $data['strategies'] = $controller->getObjectiveStrategies($objectiveId);
    $data['lead'] = $controller->getObjectiveLead($objectiveId);
    echo json_encode($data);
});
$router->post("/save_activity", function(){
    $controller = new ActivitiesController();
    $id =  $controller->saveActivity($_POST);
    http_response_code($id == null ? 412 : 200);
});
$router->post("/save_pi", function(){
    $controller = new ActivitiesController();
    $controller->savePi($_POST);
});
$router->post("/save_strategy", function(){
    $controller = new ObjectivesController();
    $id =  $controller->saveStrategy($_POST);
    http_response_code($id == null ? 412 : 200);
});
$router->post("/save_objective", function(){
    $controller = new ObjectivesController();
    $id = $controller->saveObjective($_POST);
    if($id == null) http_response_code(412);
    else {
        $goalsController = new GoalsController();
        echo json_encode($goalsController->getGoals());
    }
});
$router->post("/panel/register_request", function () {
    $userData = $_POST;
    UsersController::register($userData);
});

$router->post("/panel/login_request", function () {
    $userData = $_POST;
    UsersController::login($userData);
});

$router->post("/panel/password_reset", function () {
    $userData = $_POST;
    UsersController::password_reset($userData);
});

$router->get("/panel/get_users", function () {
    $controller = new UsersController();
    echo myJsonResponse(200, "Users Retrieved!", $controller->getUsers());
});

$router->post("/panel/save_user", function () {
    $controller = new UsersController();
    $userData = $_POST;
    $saved = $controller->saveUser($userData);
    if ($saved) echo myJsonResponse(200, "User saved.", $controller->getUsers());
    else echo myJsonResponse(400, "User not saved.");
});
$router->post("/panel/save_activity_progress", function () {
    $controller = new ProgressController();
    $activityProgress = $controller->saveActivityProgress($_POST);
    if($activityProgress != null) echo $controller->getActivityProgresses($activityProgress->activity_id);
});
$router->get("/panel/activity_progresses/{id}", function ($id) {
    $controller = new ProgressController();
    echo $controller->getActivityProgresses($id);
});
$router->get("/panel/my_activities", function (){
    $controller = new ActivitiesController();
    echo $controller->getMyActivities();
});
$router->get("/panel/get_activities", function (){
    $controller = new ActivitiesController();
    $data['my_activities'] = $controller->getMyActivities();
    $data['all_activities'] = $controller->getAllActivities();
    echo json_encode($data);
});
$router->post("/panel/save_activity_report", function () {
    $controller = new ActivitiesController();
    $report = $controller->saveActivityReport($_POST);
});
$router->get("/panel/activities_reports", function () {
    $controller = new ActivitiesController();
    echo $controller->getActivitiesReports();
});

$router->post('sendmail_test', function(){
    Utility::sendMailTest();
});
$router->get('reports_activity_report', function (){
    $controller = new \Controllers\ReportsController();
    $controller->getActivityReports();
});

$router->all("/logout", function () {
    session_start();
    if(!session_destroy()) http_response_code(412);
    echo "session destroyed";
    // header('Location: panel/login');
});
// Thunderbirds are go!
$router->run();
