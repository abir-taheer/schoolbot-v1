<?php
class Database {
    public static function secureQuery($query, $parameters, $data) {
        //Use PDO to make a secure, all purpose query function that returns a associative array
        $conn = new PDO("mysql:host=". db_host .";dbname=". db_name , db_username, db_password);
        $stmt = $conn->prepare($query);
        foreach($parameters as $key => &$value ) {
            $stmt->bindParam($key, $value);
        }
        $stmt->execute();
        if(isset($data)){
            //Check to see if we want to return any special type of data
            if( $data = "assoc" ){
                $return = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $return = $stmt->{$data}();
            }
        } else {
            $return = $stmt->fetchAll();
        }
        return $return;
    }
}