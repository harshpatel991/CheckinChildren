<?php
/**
 * The form handler when a manager submits form to promote an employee
 * Promotes the employee and redirects to the employees information page
 */

require_once(dirname(__FILE__).'/../authController.php');
require_once(dirname(__FILE__).'/../../models/dao/userDAO.php');

$authController = new authController();
$authController->verifyRole(['company','manager']);
$authController->verifyEmployeePermissions($_GET['employee_id']);
$authController->redirectPage();

$userDAO=new userDAO();
$empid=$_GET['employee_id'];
$userDAO->updateField($empid, "role", "employee");

header("Location: ../../../public/displayEmployee.php?employee_id=$empid");