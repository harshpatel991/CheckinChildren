<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2/15/15
 * Time: 8:15 PM
 */

require_once(dirname(__FILE__).'/../models/dao/employeeDAO.php');

//TODO: HAsh the password before it gets here
$employee=new employeeModel($_POST['name'], $_POST['password'], $_POST['facility_id'], $_POST['email'], $_POST['role']);

if ($employee->isValid()) {
    $employeeDAO=new $employeeDAO();
    $employeeDAO->create_DCP($employee);

    header("Location: ../../public/createEmployee.php");
    exit();
}

else{

    header("Location: ../../public/createEmployee.php?error=1");

}