<?php
session_start();
class Session {
    public static function hasSession(){
        $user = self::getUser();
        return $user->constructed;
    }

    public static function getUser() {
        return new User($_SESSION["user_id"]);
    }

    public static function makeSession($user_id){
        $_SESSION["user_id"] = $user_id;
    }
}