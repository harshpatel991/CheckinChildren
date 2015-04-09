<?php
/**
 * The form handler when a manager submits form to promote an employee
 * Promotes the employee and redirects to the employees information page
 */

require_once(dirname(__FILE__).'/../authController.php');
require_once(dirname(__FILE__) . '/../../errorManager.php');
require_once(dirname(__FILE__) .'/../../cookieManager.php');
require_once(dirname(__FILE__).'/../../models/dao/userDAO.php');
require_once(dirname(__FILE__) . '/../../models/dao/logDAO.php');


$userDAO=new userDAO();
$empid=$_GET['employee_id'];
$empname=$_GET['employee_name'];
if ($_COOKIE[cookieManager::$userRole] != 'company' && $_COOKIE[cookieManager::$userRole] != 'manager'){
    header("Location: ../../../public/displayEmployee.php?employee_id=".$empid."&error=".errorEnum::permission_error);
    exit();
}

$userDAO=new userDAO();

$userDAO->updateField($empid, "role", "manager");

$lDAO=new logDAO();
$lDAO->insert($_COOKIE[cookieManager::$userId], $empid, $empname, logDAO::$employeePromotion);


header("Location: ../../../public/displayEmployee.php?employee_id=" . $empid);