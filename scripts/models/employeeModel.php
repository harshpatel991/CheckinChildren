<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2/15/15
 * Time: 2:11 PM
 */

class employeeModel {

    public $id;
    public $name;
    public $facility_id;

    public function __construct($data)
    {
        $this->$id=$data["id"];
        $name=$data["name"];
        $facility_id=$data["facility_id"];
    }

}