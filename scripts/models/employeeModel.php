<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2/15/15
 * Time: 2:11 PM
 */

require_once(dirname(__FILE__).'/userModel.php');

class employeeModel extends userModel{
    public $name;
    public $facility_id;

    public function __construct( $name, $password, $facility_id, $email, $role, $id="")
    {
        $this->id=$id;
        $this->name=$name;
        $this->facility_id=$facility_id;
        $this->password=$password;
        $this->email=$email;
        $this->role=$role;
    }

}