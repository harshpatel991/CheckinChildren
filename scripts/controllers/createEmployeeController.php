<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once(dirname(__FILE__).'/../models/dao/employeeDAO.php');
require_once(dirname(__FILE__).'/../models/employeeModel.php');
require_once(dirname(__FILE__).'/../cookieManager.php');
require_once(dirname(__FILE__).'/managerController.php');

$manCon=new managerController();
$facility_id=$manCon->getFacilityID($_COOKIE[cookieManager::$userId]);
$hashedPassword = employeeModel::genHashPassword($_POST['password']);

$employee=new employeeModel($_POST['name'], $hashedPassword, $facility_id, $_POST['email'], $_POST['role']);

if ($employee->isValid()) {
    $employeeDAO=new employeeDAO();
    $employeeDAO->create_DCP($employee);

    header("Location: ../../public/displayEmployees.php");
    exit();
} else {
    header("Location: ../../public/createEmployee.php?error=1");
    exit();
}
