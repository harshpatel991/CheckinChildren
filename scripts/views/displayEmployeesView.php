<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2/17/15
 * Time: 4:42 PM
 */
require_once(dirname(__FILE__).'/../controllers/managerController.php');
require_once(dirname(__FILE__).'/../models/dao/employeeDAO.php');
require_once(dirname(__FILE__).'/../models/employeeModel.php');

$htmlFileLocation = dirname(__FILE__).'/../../html/managerIndex.html';

$managercontroller= new managerController();

$employeedao=new employeeDAO();
$manager = $employeedao->find($_COOKIE[cookieManager::$userId]);
$employees=$employeedao->getFacilityEmployees($manager->facility_id);

$emplist="";

foreach ($employees as $employee) {
    $emplist=$emplist.($employee->emp_name)."<br>";
}

$template=file_get_contents ($htmlFileLocation);
$template=str_replace("EMPLOYEE_LIST", $emplist, $template);
echo $template;