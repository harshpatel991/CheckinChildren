<?php


require_once(dirname(__FILE__).'/userModel.php');

class parentModel extends userModel{
    public $parent_name;
    public $address;
    public $phone_number;

    public function __construct( $parent_name="", $password="", $email="", $role="", $phone_number="", $address="", $id=0)
    {
        $this->id=$id;
        $this->parent_name=$parent_name;
        $this->password=$password;
        $this->email=$email;
        $this->role=$role;
        $this->address=$address;
        $this->phone=$phone_number;

    }

    public function isValid() {
        if (strlen($this->parent_name)>30 || strlen($this->parent_name)<=0) {
            return false;
        }

        return parent::isValid();
    }

}