<?php
/**
 * The form handler when a company submits form to edit a facility
 * Determines if submitted facility is valid and updates record in facilityDAO and redirects to displayFacility page
 * If facility information is not valid, redirects to editFacility page with error
 */
require_once(dirname(__FILE__) . '/../../models/dao/facilityDAO.php');
require_once(dirname(__FILE__) . '/../../models/dao/childDAO.php');
require_once(dirname(__FILE__) . '/../../models/dao/employeeDAO.php');
require_once(dirname(__FILE__) . '/../../models/dao/userDAO.php');

$authController = new authController();
$authController->verifyRole(['company']);
$authController->verifyFacilityPermissions($_GET["facility_id"]);
$authController->redirectPage();

$childDao = new childDAO();
$employeeDao = new employeeDAO();
$facilityDAO = new facilityDAO();
$userDAO = new userDAO();

/**
$employees = $employeeDao->getFacilityEmployees($_GET["facility_id"]);


foreach($employees as $employee)
{
    $userDAO->delete($employee->id);
}
**/
$userDAO->deleteUsersOfFacility("facility_id");
$childDao->deleteAllChildrenInFacility($_GET["facility_id"]);
$employeeDao->delete("facility_id",$_GET["facility_id"]);
$facilityDAO->delete($_GET["facility_id"]);
header("Location: ../../../public/displayFacilities.php"); //send browser to the page for newly created facility
exit();

