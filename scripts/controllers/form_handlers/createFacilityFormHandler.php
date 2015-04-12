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

$authController = new authController();
$authController->verifyRole(['company']);
$authController->redirectPage();

$company_id = $_COOKIE[cookieManager::$userId];
$facility = new facilityModel($company_id, $_POST['address'], $_POST['phone_number']); //Read in POST data from form

$error_code = $facility->isValid();
if ($error_code === 0) {
    $facilityDAO = new FacilityDAO();
    $facility_id = $facilityDAO->insert($facility);
    header("Location: ../../../public/displayFacilities.php?facility_id=".$facility_id);  //send browser to the page for newly created facility
    exit();
} else {
    header("Location: ../../../public/createFacility.php?error=".$error_code); //redirect to employee creation page with error message
    exit();
}
