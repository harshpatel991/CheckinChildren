<?php
/**
 * The form handler when a manager submits form to promote an employee
 * Promotes the employee and redirects to the employees information page
 */

require_once(dirname(__FILE__).'/../authController.php');
require_once(dirname(__FILE__) . '/../../errorManager.php');
require_once(dirname(__FILE__) .'/../../cookieManager.php');
require_once(dirname(__FILE__).'/../../models/dao/userDAO.php');

$empid=$_GET['employee_id'];
if ($_COOKIE[cookieManager::$userRole] != 'company' && $_COOKIE[cookieManager::$userRole] != 'manager'){
    header("Location: ../../../public/displayEmployee.php?employee_id=".$empid."&error=".errorEnum::permission_error);
    exit();
}

$userDAO=new userDAO();

$userDAO->updateField($empid, "role", "manager");

header("Location: ../../../public/displayEmployee.php?employee_id=" . $empid);