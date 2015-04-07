<?php
/**
 * The form handler when a manager submits form to promote an employee
 * Promotes the employee and redirects to the employees information page
 */

require_once(dirname(__FILE__).'/../authController.php');
require_once(dirname(__FILE__).'/../../models/dao/userDAO.php');
require_once(dirname(__FILE__).'/../../models/dao/employeeDAO.php');

$userDAO=new userDAO();
$employeeDAO=new employeeDAO();
$empid=$_GET['employee_id'];

$userDAO->delete($empid);
$employeeDAO->delete($empid);

header("Location: ../../../public/index.php");