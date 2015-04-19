<?php
/**
 * The form handler when a parent submits form to edit a child account
 * Determines if submitted child is valid and updates record in childDAO and redirects to displayChild page
 * If child information is not valid, redirects to editChild page with error
 */
require_once(dirname(__FILE__) . '/../authController.php');
require_once(dirname(__FILE__) . '/../../errorManager.php');
require_once(dirname(__FILE__) . '/../../cookieManager.php');
require_once(dirname(__FILE__) . '/../../models/dao/employeeDAO.php');


$authController = new authController();
$authController->verifyRole(['company']);
$authController->verifyEmployeePermissions($_GET['employee_id']);
$authController->redirectPage('../../../public/');

//Read in POST data from form
$cookieManager = new cookieManager();
$cookies = $cookieManager->getCookies();

$employDAO = new employeeDAO();
$employDAO->updateField($_GET['employee_id'], "facility_id",$_POST['facility_id'] );
header("Location: ../../../public/displayEmployee.php?employee_id".$_GET['employee_id']); //send browser to the page for newly created facility
exit();

