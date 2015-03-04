<?php
require_once((dirname(__FILE__).'/../models/dao/employeeDAO.php'));
require_once((dirname(__FILE__).'/../models/employeeModel.php'));
require_once((dirname(__FILE__).'/../models/dao/childDAO.php'));
require_once((dirname(__FILE__).'/../models/childStatusEnum.php'));
require_once((dirname(__FILE__).'/../models/childModel.php'));
require_once((dirname(__FILE__).'/../dateTimeProvider.php'));
class checkinController {

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

        foreach ($buckets as $bucket){
            usort($bucket, function($a, $b){
               return strcmp($a->child_name, $b->child_name);
            });
        }

        return $buckets;
    }

    public function getChildrenInFacility($empId){
        //TODO: Use joins to make this more efficient.
        $employeeDAO = new employeeDAO();
        $employee = $employeeDAO->find($empId);
        $childDAO = new childDAO();
        return $childDAO->findChildrenInFacility($employee->facility_id);
    }

}