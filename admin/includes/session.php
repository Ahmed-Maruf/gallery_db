<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 11/23/2017
 * Time: 3:52 AM
 */
class Session{

    public $user_id;
    private $signed_in = false;
    function __construct(){
        session_start();
        $this->check_login();
    }

    public function get_signed_in(){
        return $this->signed_in;
    }

    private function check_login(){
        if(isset($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        }else{
            unset($this->user_id);
            $this->signed_in = false;
        }
    }

    public function login($user){
        if($user){
            return $user->id;
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->signed_in = true;

        }
    }

    public function logOut(){
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in = false;
    }
}

$session = new Session();
