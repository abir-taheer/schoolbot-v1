<?php
require_once "../config.php";
spl_autoload_register(function ($class_name) {
    require_once "../classes/".$class_name . ".php";
});

$input = json_decode(file_get_contents("php://input"), true);
$user_id = $input["originalDetectIntentRequest"]["payload"]["user"]["userId"];

function returnCard($text_resp, $title, $image_url, $image_description, $button_title, $button_url) {
    echo "{
  \"payload\": {
    \"google\": {
      \"expectUserResponse\": true,
      \"richResponse\": {
        \"items\": [
          {
            \"simpleResponse\": {
              \"textToSpeech\": \"".addslashes($text_resp)."\"
            }
          },
          {
            \"basicCard\": {
              \"title\": \"".addslashes($title)."\",
              \"image\": {
                \"url\": \"".addslashes($image_url)."\",
                \"accessibilityText\": \"".addslashes($image_description)."\"
              },
              \"buttons\": [
                {
                  \"title\": \"".addslashes($button_title)."\",
                  \"openUrlAction\": {
                    \"url\": \"".addslashes($button_url)."\"
                  }
                }
              ],
              \"imageDisplayOptions\": \"WHITE\"
            }
          }
        ]
      }
    }
  }
}";
    exit;
}

function returnSimple($message){
    echo "{\"fulfillmentText\": \"".addslashes($message)."\"}";
    exit;
}


// In the case that they haven't linked their account, deliver a message with a code. Disregard all intents until linked
if( ! User::existsGoogleUser($user_id) ){
    $user = User::getUserFromApp($user_id);
    $current_app = $input["originalDetectIntentRequest"]["source"];
    $apps = ["google"=>"Google Assistant"];
    returnSimple(" Hi there! It looks like you currently haven't linked ".$apps[$current_app]." to your SchoolBot account. Go to schoolbot.org/link and use the code: ".User::makeLinkCode($user_id, $current_app));
    exit;
}

// Figure out what intent they want and response appropriately
returnSimple("Hello");
