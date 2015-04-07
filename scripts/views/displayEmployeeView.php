<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/16/15
 * Time: 10:08 PM
 */
error_reporting(E_ALL);
ini_set("display_errors",1);

require_once(dirname(__FILE__).'/../controllers/authController.php');
require_once(dirname(__FILE__).'/../models/dao/employeeDAO.php');
require_once(dirname(__FILE__).'/../models/employeeModel.php');

$employeeDAO=new employeeDAO();
$employee=$employeeDAO->find($_GET['employee_id']);
?>

<h1>Account Profile</h1>
<table id="employee_info_table" class="table">
    <tr>
        <th>Name</th>
        <td id="emp_name"><?php echo $employee->emp_name ?></td>
    </tr>
    <tr>
        <th>Email</th>
        <td id="emp_email"><?php echo $employee->email; ?></td>
    </tr>
    <tr >
        <th>Status</th>
        <td id="emp_status"><?php echo $employee->role; ?></td>
    </tr>
</table>

<br>
<?php if ($employee->role=="employee" and ($_COOKIE[cookieManager::$userRole]=="manager" or $_COOKIE[cookieManager::$userRole]=="company")) {?>
    <a class="btn btn-success" id ="promote_employee" href = "../scripts/controllers/form_handlers/promoteEmployeeFormHandler.php?employee_id=<?php echo $employee->id;?>" <span class="glyphicon glyphicon-edit" aria-hidden="true"></span > Promote Employee </a >
   <?php }
    else if ($employee->role=="manager" and $_COOKIE[cookieManager::$userRole]=="company") {?>
        <a class="btn btn-success" id ="demote_employee" href = "../scripts/controllers/form_handlers/demoteManagerFormHandler.php?employee_id=<?php echo $employee->id;?>" <span class="glyphicon glyphicon-edit" aria-hidden="true"></span > Demote Manager </a >
   <?php }
    if ($_COOKIE[cookieManager::$userRole]=="company"){
        ?><a class="btn btn-success" id ="delete_employee" href = "../scripts/controllers/form_handlers/demoteManagerFormHandler.php?employee_id=<?php echo $employee->id;?>" <span class="glyphicon glyphicon-edit" aria-hidden="true"></span > Delete Employee </a ><?php
    }
    ?>

<hr>

<a id="home" href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Home</a>