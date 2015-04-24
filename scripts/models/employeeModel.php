<?php
require_once(dirname(__FILE__).'/userModel.php');
require_once(dirname(__FILE__).'/../errorManager.php');

class employeeModel extends userModel{
    public $emp_name;
    public $facility_id;

    public function __construct( $emp_name="", $password="", $facility_id=0, $email="", $role="", $id=0, $phone_number="", $address="")
    {
        $this->id=$id;
        $this->emp_name=$emp_name;
        $this->facility_id=$facility_id;
        $this->password=$password;
        $this->email=$email;
        $this->role=$role;
        $this->phone_number=$phone_number;
        $this->address=$address;
    }

    public function isValid() {
        $error_code = $this->isUpdateValid();
        if ($error_code > 0){
            return $error_code;
        }
        return parent::isValid();
    }

    public function isUpdateValid() {
        if (strlen($this->emp_name)>30 || strlen($this->emp_name)<=0){
            return errorEnum::invalid_name;
        }

        if (strlen($this->email)>40 || strlen($this->email)<=0 || strpos($this->email, '@')===false) {
            return errorEnum::invalid_email;
        }
        if (strlen($this->password)>40){
            return errorEnum::invalid_password;
        }

        return parent::isUpdateValid();
    }

}