<?php
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
    if (!($_COOKIE[cookieManager::$userId] == $employee->id)) {
        $emplist = $emplist . '<a id='. $employee->id .' class="list-group-item" href="displayEmployee.php?employee_id=' . $employee->id . '">' . ($employee->emp_name) . '</a>';
    }
}
?>

<h1>My Employees</h1>
<ul id="employees" class="list-group">
    <?php echo $emplist;?>
</ul>

<a class="btn btn-success" href="createEmployee.php" name="create_employee"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create New Employee</a>
<hr>
<a class="btn btn-primary" id="home" href="index.php" name="back_home"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back to Home</a>
