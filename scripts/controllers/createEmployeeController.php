<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2/15/15
 * Time: 8:15 PM
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once(dirname(__FILE__).'/../models/dao/employeeDAO.php');
require_once(dirname(__FILE__).'/../models/employeeModel.php');
require_once(dirname(__FILE__).'/../cookieManager.php');
require_once(dirname(__FILE__).'/managerController.php');

$manCon=new managerController();
$facility_id=$manCon->getFacilityID($_COOKIE[cookieManager::$userId]);
//TODO: HAsh the password before it gets here
$employee=new employeeModel($_POST['name'], $_POST['password'], $facility_id, $_POST['email'], $_POST['role']);


if ($employee->isValid()) {
    $employeeDAO=new employeeDAO();

    $employeeDAO->create_DCP($employee);

    header("Location: ../../public/index.php");
    exit();
}

else{

   header("Location: ../../public/createEmployee.php?error=1");

}