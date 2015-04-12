<?php
/**
 * The form handler when a manager submits form to promote an employee
 * Promotes the employee and redirects to the employees information page
 */

require_once(dirname(__FILE__).'/../authController.php');
require_once(dirname(__FILE__).'/../../models/dao/userDAO.php');
require_once(dirname(__FILE__).'/../../models/dao/employeeDAO.php');

$authController = new authController();
$authController->verifyRole(['manager','company']);
$authController->verifyEmployeePermissions($_GET['employee_id']);
$authController->redirectPage();

$userDAO=new userDAO();
$employeeDAO=new employeeDAO();
$empid=$_GET['employee_id'];

$userDAO->delete($empid);
$employeeDAO->delete("id", $empid);

header("Location: ../../../public/index.php");