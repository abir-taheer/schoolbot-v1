<?php
require_once "../config.php";
spl_autoload_register(function ($class_name) {
    require_once "../classes/".$class_name . ".php";
});

$user = User::newUser($_POST["first"], $_POST["last"], $_POST["email"], $_POST["password"]);
Session::makeSession($user->user_id);
header("Location: /home.php");