<?php
/**
 * Created by PhpStorm.
 * User: Elzabad
 * Date: 2/19/2015
 * Time: 1:45 AM
 */
require_once(dirname(__FILE__).'/userModel.php');

class companyModel extends userModel{
    var $company_name;
    var $address;
    var $phone;

    function __construct($company_name='', $address='', $phone='', $email, $password='', $role='', $id=0) {
        $this->id = $id;
        $this->company_name = $company_name;
        $this->address = $address;
        $this->phone = $phone;
        $this->password = $password;
        $this->email = $email;
        $this->role=$role;
    }

    //Determines if this object is valid to be inserted into the database
    function isValid() {
        if(strlen($this->address) <= 0 || strlen($this->address) > 50) { //Check that address is greater than 0 and <= 50 chars
            return false;
        }

        if(strlen($this->phone) != 10) { //Check that phone is exactly 10 chars
            return false;
        }
        if(strlen($this->company_name) <= 0 || strlen($this->company_name) > 50) { //Check that the company name is greater than 0 and <= 50 chars
            return false;
        }
        return true; //otherwise it is valid
    }

}