<?php
/**
 * Created by PhpStorm.
 * User: Me
 * Date: 2/15/15
 * Time: 4:49 PM
 */

class facilityModel {

    var $facility_id;
    var $company_id;
    var $address;
    var $phone;

    function __construct($company_id='', $address='', $phone='', $facility_id='') {
        $this->facility_id = $facility_id;
        $this->company_id = $company_id;
        $this->address = $address;
        $this->phone = $phone;
    }

    //Determines if this object is valid to be inserted into the database
    function isValid() {
        if(strlen($this->address) <= 0 || strlen($this->address) > 50) { //Check that address is greater than 0 and <= 50 chars
            return false;
        }

        if(strlen($this->phone) != 10) { //Check that phone is exactly 10 chars
            return false;
        }

        return true; //otherwise it is valid
    }

}