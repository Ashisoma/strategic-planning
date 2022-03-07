<?php

namespace Controllers;

class BaseController
{


    public $user = null;
    public function __construct()
    {
        //Basic authentication //#endregion
        $sessionData = null;
        require_once("./auth.php");
        $this->user = $sessionData['user'];
    }

    public function getUser(){
        return $this->user;
    }
}
