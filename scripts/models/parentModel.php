<?php

require_once(dirname(__FILE__).'/userModel.php');

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
        if ($this->isUpdateValid() && parent::isValid()) {
            return true;
        }
        return false;
    }

    public function isUpdateValid() {
        if (strlen($this->parent_name)>30 || strlen($this->parent_name)<=0 || strlen($this->phone_number)!=10 || strlen($this->address)==0 || strlen($this->address)>50) {
            return false;
        }

        return parent::isUpdateValid();
    }

}