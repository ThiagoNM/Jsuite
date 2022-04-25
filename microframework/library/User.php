<?php

namespace My;

class User {


    const COOKIE_NAME = "session_token";

    public static function getId() : int
    {
        $uid = $user["id"];
        return $uid;
    }

    public static function getToken() : string
    {
        session_start();
        return $_SESSION['session_token'];
    }

    public static function isAuthenticated() : bool
    {
        if(isset($_COOKIE['session_token'])) {
            return true;
        }else{
            return false;
        }
    }

}