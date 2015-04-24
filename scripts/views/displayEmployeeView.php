<?php
/**
 * The view that contains the html that one sees when viewing a particular employee's profile
 * Depending on the user, it contains links to edit or delete the employee's profile,
 * move the employee to a different facility, and promote/demote an employee to/from a manager
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
        <th>Phone Number</th>
        <td id="phone_number"><?php echo $employee->phone_number; ?></td>
    </tr>
    <tr >
        <th>Address</th>
        <td id="address"><?php echo $employee->address; ?></td>
    </tr>
    <tr >
        <th>Status</th>
        <td id="emp_status"><?php echo $employee->role; ?></td>
    </tr>
</table>

<br>

<?php if ($employee->role=="employee" and ($_COOKIE[cookieManager::$userRole]=="manager" or $_COOKIE[cookieManager::$userRole]=="company")) {?>
    <a class="btn btn-success" id ="promote_employee" href = "../scripts/controllers/form_handlers/promoteEmployeeFormHandler.php?employee_id=<?php echo $employee->id;?>&employee_name=<?php echo $employee->emp_name; ?>" <span class="glyphicon glyphicon-edit" aria-hidden="true"></span > Promote Employee </a >
   <?php }
    else if ($employee->role=="manager" and $_COOKIE[cookieManager::$userRole]=="company") {?>
        <a class="btn btn-success" id ="demote_employee" href = "../scripts/controllers/form_handlers/demoteManagerFormHandler.php?employee_id=<?php echo $employee->id;?>" <span class="glyphicon glyphicon-edit" aria-hidden="true"></span > Demote Manager </a >
   <?php }
    if ($_COOKIE[cookieManager::$userRole]=="company"){
        ?><a class="btn btn-success" id ="delete_employee" href = "../scripts/controllers/form_handlers/deleteEmployeeFormHandler.php?employee_id=<?php echo $employee->id;?>" <span class="glyphicon glyphicon-edit" aria-hidden="true"></span > Delete Employee </a ><?php
    }
    ?>
<hr>

<a id="home" href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Home</a>