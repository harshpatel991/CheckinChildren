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

    function __construct($facility_id, $company_id, $address, $phone) {
        $this->$facility_id = $facility_id;
        $this->$company_id = $company_id;
        $this->$address = $address;
        $this->$phone = $phone;
    }

}