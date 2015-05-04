<?php

require_once((dirname(__FILE__).'/../models/dao/employeeDAO.php'));
require_once((dirname(__FILE__).'/../models/employeeModel.php'));

/**
 * Class managerController
 *
 * This class controls operations on manager models.
 */
class managerController {

    /**
     * Get all employees from the current facility.
     *
     * @param int $facility_id The facility id.
     * @return employeeModel[] The array of employees.
     */
    public function getEmployees($facility_id){

        $employeeDAO=new employeeDAO();

        return $employeeDAO->getFacilityEmployees($facility_id);

    }

    /**
     * Get the facility id associated with the current manager.
     *
     * @param int $manager_id The manager's id.
     * @return int The facility id.
     */
    public function getFacilityID($manager_id){
        $employeeDAO=new employeeDAO();

        $manager=$employeeDAO->find($manager_id);
        return $manager->facility_id;
    }

}