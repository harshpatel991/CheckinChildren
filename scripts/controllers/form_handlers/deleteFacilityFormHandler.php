<?php
/**
 * The form handler when a company submits form to edit a facility
 * Determines if submitted facility is valid and updates record in facilityDAO and redirects to displayFacility page
 * If facility information is not valid, redirects to editFacility page with error
 */
require_once(dirname(__FILE__) . '/../../models/dao/facilityDAO.php');
require_once(dirname(__FILE__) . '/../../models/dao/childDAO.php');
require_once(dirname(__FILE__) . '/../../models/dao/employeeDAO.php');

$childDao = new childDAO();
$employeeDao = new employeeDAO();
$facilityDAO = new facilityDAO();
//$children = $childDao->findChildrenInFacility($facility->facility_id);
//$employees = $employeeDao->getFacilityEmployees($facility->facility_id);
//$facility = new facilityModel($_POST["company_id"], $_POST["address"],$_POST["phone"], $_POST["facility_id"]);

$childDao->deleteAllChildrenInFacility($_GET["facility_id"]);
$employeeDao->deleteAllEmployeesInFacility($_GET["facility_id"]);
$facilityDAO->delete($_GET["facility_id"]);
header("Location: ../../../public/displayFacilities.php"); //send browser to the page for newly created facility
exit();

