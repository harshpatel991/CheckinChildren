<?php

require_once(dirname(__FILE__).'/userModel.php');
require_once(dirname(__FILE__).'/employeeModel.php');
require_once(dirname(__FILE__).'/dao/facilityDAO.php');

class managerModel extends employeeModel{

    public function __construct( $emp_name="", $password="", $facility_id=0, $email="", $id=0) {
        parent::__construct($emp_name, $password, $facility_id, $email, 'manager', $id);
    }

}