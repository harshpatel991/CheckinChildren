<?php
/**
 * The form handler when a company submits form to move an employee to a different facility
 * Updates the employee's facility_id in the database using the employeeDAO and redirects to displayEmployee page
 */
require_once(dirname(__FILE__) . '/../authController.php');
require_once(dirname(__FILE__) . '/../../errorManager.php');
require_once(dirname(__FILE__) . '/../../cookieManager.php');
require_once(dirname(__FILE__) . '/../../models/dao/employeeDAO.php');


$authController = new authController();
$authController->verifyRole(['company']);
$authController->verifyEmployeePermissions($_GET['employee_id']);
$authController->verifyFacilityPermissions($_POST['facility_id']);
$authController->redirectPage('../../../public/');

//Read in POST data from form
$cookieManager = new cookieManager();
$cookies = $cookieManager->getCookies();

$employDAO = new employeeDAO();
$employDAO->updateField($_GET['employee_id'], "facility_id",$_POST['facility_id'] );
header("Location: ../../../public/displayEmployee.php?employee_id=".$_GET['employee_id']); //send browser to the page for newly created facility
exit();

