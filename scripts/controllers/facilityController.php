<?php

require_once(dirname(__FILE__).'/../models/dao/facilityDAO.php');

class facilityController {

    public function getAllFacilities($companyId) {
        $facilityDAO = new FacilityDAO();
        return $facilityDAO->findFacilitiesInCompany($companyId);
    }

    public function getFacility($facilityId) {
        $facilityDAO = new FacilityDAO();
        return $facilityDAO->find($facilityId);
    }

}
