<?php

require_once((dirname(__FILE__).'/../models/dao/employeeDAO.php'));
require_once((dirname(__FILE__).'/../models/employeeModel.php'));
require_once((dirname(__FILE__).'/../models/dao/childDAO.php'));
require_once((dirname(__FILE__).'/../models/childStatusEnum.php'));
require_once((dirname(__FILE__).'/../models/childModel.php'));
require_once((dirname(__FILE__).'/../dateTimeProvider.php'));

/**
 * Class checkinController
 *
 * Controller to get and organize data for the checkinChildren page
 */
class checkinController {

    /**
     * Get children sorted into "buckets" based on their statuses.
     * Buckets are indexed by childStatus enum.
     *
     * @param int $empId The employee's id
     * @return childModel[] The children "sorted" into different buckets
     */
    public function getChildrenBuckets($empId){
        $children = $this->getChildrenInFacility($empId);
        $buckets = array(
            childStatus::here_due => [],
            childStatus::here_ok => [],
            childStatus::not_here_late => [],
            childStatus::not_here_due => [],
            childStatus::not_here_ok => [],
        );

        $currTime = dateTimeProvider::getCurrentDateTime();
        foreach ($children as $child){
            array_push($buckets[$child->getStatus($currTime)], $child);
        }

        for($i=0; $i<sizeof($buckets); $i++){
            usort($buckets[$i], function($a, $b){
               return strcmp($a->child_name, $b->child_name);
            });
        }

        return $buckets;
    }

    /**
     * Get all children found in the employee's facility.
     *
     * @param int $empId The employee's id
     * @return childModel[] The children in the facility
     */
    public function getChildrenInFacility($empId){
        $employeeDAO = new employeeDAO();
        $employee = $employeeDAO->find($empId);
        $childDAO = new childDAO();
        return $childDAO->findChildrenInFacility($employee->facility_id);
    }

}