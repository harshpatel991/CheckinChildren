<?php
/**
 * The form handler when a employee submits form to create a new employee account
 * Determines if submitted employee is valid and adds to employeeDAO and redirects to displayEmployees page
 * If employee account is not valid, redirects to createEmployee page with error
 */
require_once(dirname(__FILE__) . '/../authController.php');
require_once(dirname(__FILE__) . '/../../errorManager.php');
require_once(dirname(__FILE__) . '/../../models/dao/employeeDAO.php');
require_once(dirname(__FILE__) . '/../../models/dao/logDAO.php');
require_once(dirname(__FILE__) . '/../../models/employeeModel.php');
require_once(dirname(__FILE__) . '/../../cookieManager.php');
require_once(dirname(__FILE__) . '/../managerController.php');

$authController = new authController();
$authController->verifyRole(['employee','manager']);
$authController->redirectPage();

$manCon=new managerController();
$cookieManager = new cookieManager();
$cookies = $cookieManager->getCookies();

$facility_id=$manCon->getFacilityID($cookies[cookieManager::$userId]);
$hashedPassword = employeeModel::genHashPassword($_POST['password']);

$employee=new employeeModel($_POST['name'], $hashedPassword, $facility_id, $_POST['email'], $_POST['role']); //retreieve submitted POST data
$lDAO=new logDAO();

$error_code = 0;
$error_code = $employee->isValid();
echo $error_code;
if ($error_code===0) {
    $employeeDAO=new employeeDAO();
    $empId=$employeeDAO->create_DCP($employee);
    $lDAO->insert($cookies[cookieManager::$userId], $empId, $employee->emp_name, logDAO::$employeeCreated);
    header("Location: ../../../public/displayEmployees.php");
    exit();
} else {
    $lDAO->insert($cookies[cookieManager::$userId], null, $employee->emp_name, logDAO::$employeeCreated, "Error: ".errorManager::getErrorMessage($error_code));
    header("Location: ../../../public/createEmployee.php?error=".$error_code);
    exit();
}
