<?php
class User {
    public $user_id, $first, $last, $email, $constructed;
    private $password;
    public function __construct($user_id) {
        $data = Database::secureQuery("SELECT * FROM  `users` WHERE `user_id` = :uid", array(":uid" => $user_id), 'fetch');
        $this->constructed = count($data) > 1;
        $this->user_id = $data["user_id"];
        $this->first = $data["first"];
        $this->last = $data["last"];
        $this->email = $data["email"];
        $this->password;
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

    public static function userByEmail($email){
        $data = Database::secureQuery("SELECT * FROM `users` WHERE `email` = :email", array(":email"=>trim($email)), 'fetch');
        return new User($data["user_id"]);
    }

    public function validatePassword($pass){
        return password_verify ( $pass , $this->password );
    }

    public function newUser($first, $last, $email, $password){
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $uid = bin2hex(random_bytes(32));
        Database::secureQuery("INSERT INTO `users` (`user_id`, `first`, `last`, `email`, `password`) VALUES (:uid, :f, :l, :e, :p)", array(":uid"=>$uid, ":f"=>$first, ":l"=>$last, ":e"=>$email, ":p"=>$hashed_password), null);
        return new User($uid);
    }
}