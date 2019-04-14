<?php
class LinkCode {
    public $code, $app_user_id, $app_id, $timestamp, $constructed, $array;
    public function __construct($code){
        $data = Database::secureQuery("SELECT * FROM `app_assoc_codes` WHERE `verification_code` = :v" ,array(":v"=>$code), 'fetch');
        $this->constructed = count($data) > 1;
        $this->app_user_id = $data["app_user_id"];
        $this->app_id = $data["app_id"];
        $this->timestamp = $data["time_stamp"];
        $this->code = $data["verification_code"];
        $this->array = $data;
    }
}