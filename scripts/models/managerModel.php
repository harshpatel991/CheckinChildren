<?php

require_once(dirname(__FILE__).'/userModel.php');
require_once(dirname(__FILE__).'/employeeModel.php');
require_once(dirname(__FILE__).'/dao/facilityDAO.php');

/**
 * Class managerModel used to represent managers
 */
class managerModel extends employeeModel{

    /**
     * used to construct a new manager
     * @param string $emp_name the employee's name
     * @param string $password their password
     * @param int $facility_id which facility they work at
     * @param string $email their email
     * @param int $id a unique identifier
     * @param string $address their home address
     * @param string $phone_number their phone number

     */
    public function __construct( $emp_name="", $password="", $facility_id=0, $email="", $id=0, $address='', $phone_number='') {
        parent::__construct($emp_name, $password, $facility_id, $email, 'manager', $id, $phone_number, $address);
    }

}