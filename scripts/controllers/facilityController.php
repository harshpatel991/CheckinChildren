<?php

require_once(dirname(__FILE__).'/../models/dao/facilityDAO.php');

/**
 * Class facilityController
 *
 * This classs is called by the facility view in order to access the facility DAO objects.
 */

class facilityController {

    /**
     * @param int $companyId The id of the company whose facility we wish to retrieve
     * @return array An array of facilities who the company manages
     */
    public function getAllFacilities($companyId) {
        $facilityDAO = new FacilityDAO();
        return $facilityDAO->findFacilitiesInCompany($companyId);
    }

    /**
     * @param int $facilityId Gets the facility information by this id
     * @return mixed Returns the facility info if the id is valid, and 0 if it does not
     */
    public function getFacility($facilityId) {
        $facilityDAO = new FacilityDAO();
        return $facilityDAO->find($facilityId);
    }

}
