<?php
require_once "../config.php";
spl_autoload_register(function ($class_name) {
    require_once "../classes/".$class_name . ".php";
});

if(! Session::hasSession() ) {
    header("Location: /");
    exit;
}

$user = Session::getUser();

$user->addApp($_POST["link_code"], $_POST["title"]);
header("Location: /home.php");
setcookie("notification", base64_encode("That app has successfully been added. You may now use SchoolBot with that app!"), strtotime("+1 day"),  "/");