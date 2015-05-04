<?php

require_once(dirname(__FILE__).'/userModel.php');
require_once(dirname(__FILE__).'/../errorManager.php');

/**
 * Class companyModel used to represent companies
 */
class companyModel extends userModel{
    var $company_name;
    var $address;
    var $phone;

    /**
     * Constructor class takes in all the values needed
     * @param string $company_name the name of the company
     * @param string $address the companies main address
     * @param string $phone phone number
     * @param string $email email they can be reachedat
     * @param string $password password to be stored
     * @param string $role role which will be "company"
     * @param int $id unique identifier for the company and login
     */
    function __construct($company_name='', $address='', $phone='', $email = '', $password='', $role='', $id=0) {
        $this->id = $id;
        $this->company_name = $company_name;
        $this->address = $address;
        $this->phone = $phone;
        $this->password = $password;
        $this->email = $email;
        $this->role=$role;
    }

    /**
     * Checks if the company is valid
     * @return int either 0 for good or some other error code
     */
    public function isValid() {
        $error_code = $this->isUpdateValid();
        if ($error_code > 0){
            return $error_code;
        }
        return parent::isValid();
    }

    /**
     * checks if the update to the company is valid
     * @return int either 0 for good or some other error code
     */
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