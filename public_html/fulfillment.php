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

function returnList($string){
    echo "{
  \"payload\": {
    \"google\": {
      \"expectUserResponse\": true,
      \"richResponse\": {
        \"items\": [
          {
            \"simpleResponse\": {
              \"textToSpeech\": \"Here is this week's schedule:\"
            }
          }
        ]
      },
      \"systemIntent\": {
        \"intent\": \"actions.intent.OPTION\",
        \"data\": {
          \"@type\": \"type.googleapis.com/google.actions.v2.OptionValueSpec\",
          \"listSelect\": {
            \"title\": \"This Week's Schedule\",
            \"items\": [
              ".$string."
            ]
          }
        }
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

$user = User::getUserFromApp($user_id);

$intent = $input["queryResult"]["intent"]["name"];

// Figure out what intent they want and response appropriately
switch($intent){
    case "projects/myschool-2dc85/agent/intents/fdaad76f-c4f6-4602-802b-a80c76c4d9db":
        returnSimple("Hello ".$user->first);
    case "projects/myschool-2dc85/agent/intents/8f9cb691-1d40-407b-83a5-5d3de4b9acab":
        $school = $user->getSchools()[0];
        $update = $school->getUpdates()[0];
        returnCard("Here is the most recent update:", $update["title"], $update["pic"], "Update Image", "View Update", "https://schoolbot.org/schools.php?id=".$school->school_code);
    case "projects/myschool-2dc85/agent/intents/6835033a-38a9-4c08-915e-aae750431d8d":
        $school = $user->getSchools()[0];
        $form = $school->getClosestResource($input["queryResult"]["parameters"]["form"]);
        returnCard("Here is the form I think you're looking for: ", $form["name"], "https://schoolbot.org/static/img/file.png", "File Image", "View Resource", $form["url"]);
    case "projects/myschool-2dc85/agent/intents/c901a768-9c3d-4c4d-9e67-c8287117159f":
        $school = $user->getSchools()[0];
        $days = $school->getSchedule();
        $string = "";
        $lastElement = end($days);
        foreach($days as $day){
            $string .= "{
                \"optionInfo\": {
                  \"key\": \"".$day["date"]."\"
                },
                \"description\": \"Schedule for that day: ".$day["day_type"]."\",
                \"title\": \"".$day["date"]."\"
              }";
            if( $day !== $lastElement ){
                $string.= ",";
            }
        }
        returnList($string);

}
returnSimple("Hello ".$user->first);
