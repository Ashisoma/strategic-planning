<?php
namespace Controllers;

use Controllers\Utils\Utility;
use Models\User;

class UsersController extends BaseController{

    public function __construct(){
        parent::__construct();
        $this->user = parent::getUser();
    }

    public function saveUser($userData){
        try{
            if(isset($userData['id'])) $id = trim($userData['id']);
            if($id != NULL && $id != ""){
                $user = User::findOrFail($id);
                $user->name = $userData['names'];
                $user->gender = $userData['gender'];
                $user->operation_base = $userData['operation_base'];
                $user->designation = $userData['designation'];
                $user->email = $userData['email'];
                $user->mobile = $userData['mobile'];
                $user->save();
            } else {
                User::create([
                    "name" => $userData['names'],
                    "gender" => $userData['gender'],
                    "operation_base" => $userData['operation_base'],
                    "designation" => $userData['designation'],
                    "email" => $userData['email'],
                    "mobile" => $userData['mobile']
                ]);
            }

            return true;

        } catch(\Throwable $e){
            Utility::logError($e->getCode(), $e->getMessage());
            http_response_code(412);
            return false;
        }
    }

    public function getUsers() {
        return User::all();
    }

    public static function register($userData)
    {
        try {
            $email = $userData['email'];
            $password = $userData['password'];
            $user = User::where('email', $email)->where('active', 0)->firstOrFail();
            if ($user == null) throw new \Exception("User Not found.", -1);
            $user->password = password_hash($password, PASSWORD_DEFAULT);
            $user->active = 1;
            $user->save();
            echo myJsonResponse(200, "User registered successfully", $user);
        } catch (\Throwable $e) {
            Utility::logError($e->getCode(), $e->getMessage());
            echo myJsonResponse($e->getCode(), "Error encountered. Try again later.", $e->getMessage());
        }
    }

    public static function password_reset($userData) 
    {
        try {
            //code...
            $email = $userData['email'];
            $user = User::where('email', $email)->firstOrFail();
            if ($user == null) {
                new \Throwable("");
                throw new \Throwable("User Not found.", 1);
                echo myJsonResponse( "Error encountered. Try again later.","Error encountered. Try again later.");
                
            }
            $user->active = 0;
            $user->save();

        } catch (\Throwable $th) {
            //throw $th;
            Utility::logError($th->getCode(), $th->getMessage());
            echo myJsonResponse($th->getCode(), "Error encountered. Try again later.", $th->getMessage());
        }
    }
    public static function login($userData)
    {
        try {
            $email = $userData['email'];
            $password = $userData['password'];
            $user = User::where('email', $email)->where('active', 1)->firstOrFail();
            if (password_verify($password, $user->password)) {
                $user->last_login = date("Y:m:d h:i:s", time());
                $user->save();
                session_start();
                $sessionData = [];
                $sessionData['user'] = $user;
                $sessionData['expires_at'] = time() + ($_ENV['SESSION_DURATION'] * 60);
                $_SESSION[$_ENV['SESSION_APP_NAME']] = $sessionData;
                echo myJsonResponse(200, 'Logged in', $user);
            } else throw new \Exception("Invalid Credentials.", 1);
        } catch (\Throwable $e) {
            Utility::logError($e->getCode(), $e->getMessage());
            echo myJsonResponse($e->getCode(), "Error encountered. Try again later.", $e->getMessage());
        }
    }
}
