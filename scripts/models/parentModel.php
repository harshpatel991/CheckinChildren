<?php

require_once(dirname(__FILE__).'/userModel.php');
require_once(dirname(__FILE__).'/../errorManager.php');

class parentModel extends userModel{
    public $parent_name;
    public $address;
    public $phone_number;
    public $carrier;
    public $contact_pref;

    public function __construct( $parent_name="", $password="", $email="", $role="", $phone_number="",
                                 $address="", $contact_pref="", $carrier="", $id=0)
    {
        $this->id=$id;
        $this->parent_name=$parent_name;
        $this->password=$password;
        $this->email=$email;
        $this->role=$role;
        $this->address=$address;
        $this->phone_number=$phone_number;
        $this->carrier= $carrier;
        $this->contact_pref=$contact_pref;
    }

    public function isValid() {
        $error_code = $this->isUpdateValid();
        if ($error_code > 0){
            return $error_code;
        }
        return parent::isValid();
    }

    public function isUpdateValid() {
        if (strlen($this->parent_name)>30 || strlen($this->parent_name)<=0){
            return errorEnum::invalid_name;
        }
        if (strlen($this->phone_number)!=10 || !is_numeric($this->phone_number)){
            return errorEnum::invalid_phone;
        }
        if (strlen($this->address)==0 || strlen($this->address)>50){
            return errorEnum::invalid_address;
        }
        if (strpos($this->contact_pref,'text')!==false && strlen($this->carrier)===0){
            return errorEnum::missing_carrier;
        }

        return parent::isUpdateValid();
    }

}