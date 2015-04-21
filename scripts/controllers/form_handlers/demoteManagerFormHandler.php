<?php
/**
 * The form handler when a manager submits form to promote an employee
 * Promotes the employee and redirects to the employees information page
 */

require_once(dirname(__FILE__).'/../authController.php');
require_once(dirname(__FILE__).'/../../models/dao/userDAO.php');
require_once(dirname(__FILE__) . '/../../models/dao/logDAO.php');
require_once(dirname(__FILE__) . '/../../models/dao/employeeDAO.php');
$lDAO=new logDAO();
$userDAO=new userDAO();
$empid=$_GET['employee_id'];
$userDAO->updateField($empid, "role", "employee");

$employeeDAO=new employeeDAO();

$employee=$employeeDAO->find($empid);


$lDAO->companyInsert(false, $_COOKIE[cookieManager::$userId], $empid, $employee->emp_name,logDAO::$demoteManager);
header("Location: ../../../public/displayEmployee.php?employee_id=$empid");

