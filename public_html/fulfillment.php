<?php
require_once "../config.php";
spl_autoload_register(function ($class_name) {
    require_once "../classes/".$class_name . ".php";
});

$input = json_decode(file_get_contents("php://input"), true);
$user_id = $input["originalDetectIntentRequest"]["payload"]["user"]["userId"];

if( ! User::existsGoogleUser($user_id) ){
    $user = User::getUserFromApp($user_id);
    $current_app = $input["originalDetectIntentRequest"]["source"];
    $apps = ["google"=>"Google Assistant"];
    echo "{\"fulfillmentText\": \"  Hi there! It looks like you currently haven't linked ".$apps[$current_app]." to your SchoolBot account. Go to schoolbot.org/link and use the code: ".User::makeLinkCode($user_id, $current_app)."\"}";
    exit;
}

echo "{\"fulfillmentText\": \"you do not have an account ".$input["originalDetectIntentRequest"]["payload"]["user"]["userId"]." dfs\"}";