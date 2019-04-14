<?php
class User {
    public $user_id, $name, $email;
    public function __construct($user_id) {
        $data = Database::secureQuery("SELECT * FROM  `users` WHERE `user_id` = :uid", array(":uid" => $user_id), 'fetch');
        $this->user_id = $data["user_id"];
        $this->name = $data["name"];
        $this->email = $data["email"];
    }
    public static function existsGoogleUser($user_id){
        return Database::secureQuery("SELECT COUNT(*) as `hasAccount` FROM `user_app_assoc` WHERE `app_user_id` = :id", array(":id"=>$user_id), 'fetch')["hasAccount"] !== "0";
    }

    public static function makeLinkCode($app_user_id, $app_code){
        $vf = bin2hex(random_bytes(4));

        Database::secureQuery("INSERT INTO `app_assoc_codes` (`verification_code`, `app_user_id`, `app_id`) VALUES (:vf, :auid, :aid)",
            array(":vf"=>$vf, ":auid"=>$app_user_id, ":aid"=>$app_code), null);

        return $vf;
    }

    public static function getUserFromApp($app_id){
        $data = Database::secureQuery("SELECT users.`user_id` FROM `users` INNER JOIN user_app_assoc uaa on users.user_id = uaa.user_id WHERE `app_user_id` = :app_id", array(":app_id" => $app_id), 'fetch');
        return new User($data["user_id"]);
    }
}