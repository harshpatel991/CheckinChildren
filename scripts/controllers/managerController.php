<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2/16/15
 * Time: 9:17 PM
 */

require_once((dirname(__FILE__).'/../models/dao/employeeDAO.php'));
require_once((dirname(__FILE__).'/../models/employeeModel.php'));
class managerController {

    public function getEmployees($facility_id){

        $employeeDAO=new employeeDAO();

        return $employeeDAO->getFacilityEmployees($facility_id);

    }

    public function getFacilityID($manager_id){
        $employeeDAO=new employeeDAO();

        $manager=$employeeDAO->find($manager_id);
        return $manager->facility_id;
    }

}