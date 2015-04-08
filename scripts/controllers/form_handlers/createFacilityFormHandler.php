<?php

/**
 * The form handler when a company submits form to create a new facility
 * Determines if submitted facility is valid and adds to facilityDAO and redirects to displayFacilities page
 * If facility information is not valid, redirects to createFacility page with error
 */
require_once(dirname(__FILE__) . '/../authController.php');
require_once(dirname(__FILE__) . '/../../errorManager.php');
require_once(dirname(__FILE__) . '/../../cookieManager.php');
require_once(dirname(__FILE__) . '/../../models/dao/facilityDAO.php');

if($_COOKIE[cookieManager::$userRole] != 'company'){
    header("Location: ../../../public/createFacility.php?error=".errorEnum::permission_error);
    exit();
}

$company_id = $_COOKIE[cookieManager::$userId];
$facility = new facilityModel($company_id, $_POST['address'], $_POST['phone_number']); //Read in POST data from form

if ($facility->isValid()) {
    $facilityDAO = new FacilityDAO();
    $facility_id = $facilityDAO->insert($facility);

    header("Location: ../../../public/displayFacilities.php?facility_id=".$facility_id);  //send browser to the page for newly created facility
    exit();
} else {
    header("Location: ../../../public/createFacility.php?error=1"); //redirect to employee creation page with error message
    exit();
}
