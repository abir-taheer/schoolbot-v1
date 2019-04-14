<?php
require_once "../config.php";
spl_autoload_register(function ($class_name) {
    require_once "../classes/".$class_name . ".php";
});

$user = User::userByEmail($_POST["email"]);

if( ! $user->constructed || ! $user->validatePassword($_POST["password"]) ){
    header("Location: /login.php?redirect=/home.php");
    setcookie("notification", base64_encode("Sign in failed!"), strtotime("+1 day"), "/");
    exit;
}
Session::makeSession($user->user_id);
header("Location: /home.php");
