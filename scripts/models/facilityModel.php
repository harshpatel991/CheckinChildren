<?php
/**
 * Created by PhpStorm.
 * User: Me
 * Date: 2/15/15
 * Time: 4:49 PM
 */
require_once(dirname(__FILE__).'/../errorManager.php');

/**
 * Class facilityModel used to repsent the facilities a company has
 */
class facilityModel {

    var $facility_id;
    var $company_id;
    var $address;
    var $phone;

    /**
     * used to cconstruct a new facility
     * @param int $company_id id of the company that owns the facility
     * @param string $address address of the facility
     * @param string $phone phone number for the facility
     * @param int $facility_id unique identifier for the facility
     */
    function __construct($company_id=0, $address='', $phone='', $facility_id=0) {
        $this->facility_id = $facility_id;
        $this->company_id = $company_id;
        $this->address = $address;
        $this->phone = $phone;
    }

    /**
     * Checks if the facility si valid for entry into database or updating
     * @return int either 0 for good or some other error code
     */
    function isValid() {
        if(strlen($this->address) <= 0 || strlen($this->address) > 50) { //Check that address is greater than 0 and <= 50 chars
            return errorEnum::invalid_address;
        }

        if(strlen($this->phone) != 10 || !is_numeric ($this->phone)) { //Check that phone is exactly 10 numbers
            return errorEnum::invalid_phone;
        }

        return 0; //otherwise it is valid
    }

}