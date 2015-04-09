<?php
/**
 * Created by PhpStorm.
 * User: Elzabad
 * Date: 2/19/2015
 * Time: 1:45 AM
 */
require_once(dirname(__FILE__).'/userModel.php');
require_once(dirname(__FILE__).'/../errorManager.php');


class companyModel extends userModel{
    var $company_name;
    var $address;
    var $phone;

    function __construct($company_name='', $address='', $phone='', $email = '', $password='', $role='', $id=0) {
        $this->id = $id;
        $this->company_name = $company_name;
        $this->address = $address;
        $this->phone = $phone;
        $this->password = $password;
        $this->email = $email;
        $this->role=$role;
    }

    public function isValid() {
        $error_code = $this->isUpdateValid();
        if ($error_code > 0){
            return $error_code;
        }
        return parent::isValid();
    }

    public function isUpdateValid()
    {
        if (strlen($this->company_name) > 30 || strlen($this->company_name) <= 0) {
            return errorEnum::invalid_name;
        }
        if (strlen($this->phone) != 10 || !is_numeric($this->phone)) {
            return errorEnum::invalid_phone;
        }
        if (strlen($this->address) == 0 || strlen($this->address) > 50) {
            return errorEnum::invalid_address;
        }
        return parent::isUpdateValid();
    }

}