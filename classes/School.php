<?php
class School {
    public $constructed, $school_code, $name;
    public function __construct($id)
    {
        $data = Database::secureQuery("SELECT * FROM `schools` WHERE `id` = :id ", array(":id"=>$id), 'fetch');
        $this->constructed = count($data) > 1;
        $this->school_code = $data["id"];
        $this->name = $data["name"];
        $this->pic = $data["pic"];
    }

    public function getUpdates(){
        return Database::secureQuery("SELECT * FROM `school_updates` WHERE `school_id` = :id", array(":id"=>$this->school_code), null);
    }

    public static function getAllSchools() {
        $data = Database::secureQuery("SELECT * FROM `schools`", [], null);
        $schools = [];
        foreach( $data as $d ){
            $schools[] = new School($d["id"]);
        }
        return $schools;
    }
    public function getAllResources(){
        return Database::secureQuery("SELECT * FROM `resources` WHERE `school_id` = :i",array(":i"=>$this->school_code), null);
    }

    public function getClosestResource($name){
        $resources = $this->getAllResources();
        $curr_greatest = 0;
        $gr_item = [];
        foreach($resources as $r){
            if( similar_text ( $r["name"] , $name ) > $curr_greatest ){
                $gr_item = $r;
                $curr_greatest = similar_text ( $r["name"] , $name ) ;
            }
        }
        return $gr_item;
    }

    public function getSchedule(){
        return Database::secureQuery("SELECT * FROM `school_schedules` WHERE `school_id` = :id", array("id"=>$this->school_code), null);
    }
}