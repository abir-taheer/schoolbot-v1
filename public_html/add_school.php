<?php
require_once "../config.php";
spl_autoload_register(function ($class_name) {
    require_once "../classes/".$class_name . ".php";
});

$user = Session::getUser();
$track = bin2hex(random_bytes(32));
Database::secureQuery("INSERT INTO `user_school_assoc`(`track`, `user_id`, `school_id`) VALUES (:t, :u, :s)", array(":t"=>$track, ":u"=>$user->user_id, ":s"=>$_GET["school"]), null);
setcookie("notification", base64_encode("You have successfully joined this school."), strtotime("+7 days"), "/");
header("Location: /schools.php?id=".$_GET["school"]);