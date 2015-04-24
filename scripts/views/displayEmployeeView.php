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
require_once(dirname(__FILE__) . '/../controllers/facilityController.php');
require_once(dirname(__FILE__).'/../models/dao/facilityDAO.php');
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
    if ($_COOKIE[cookieManager::$userRole]=="company"){?>
        <a class="btn btn-success" id ="delete_employee" href = "../scripts/controllers/form_handlers/deleteEmployeeFormHandler.php?employee_id=<?php echo $employee->id;?>" <span class="glyphicon glyphicon-edit" aria-hidden="true"></span > Delete Employee </a >
        <a class="btn btn-success confirm-submit" data-toggle="modal" data-target="#confirmModal"id="move_employee"><span class="glyphicon glyphicon-move" aria-hidden="true"></span>Move</a>
        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="confirmModalLabel">Move Employee</h4>
                    </div>
                    <div class="modal-body">
                        <?php
                        $facilityDAO = new facilityDAO();
                        $facility = $facilityDAO->find($employee->facility_id);
                        ?>
                        <table>
                            <tr>
                                <th><u> Current Facility</u></th>
                            </tr>
                            <tr>
                                <th>ID:</th>
                                <td><?php echo $employee->facility_id; ?></td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td><?php echo $facility->address; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <form method="post" action="../scripts/controllers/form_handlers/moveEmployeeFormHandler.php?employee_id=<?php echo $_GET['employee_id']; ?>">
                            <div class="form-group" align="left">
                                <select  id="facility_id" name="facility_id">
                                    <?php
                                    $facilityController = new facilityController();
                                    $companyId = $_COOKIE[cookieManager::$userId];
                                    $facilities = $facilityController->getAllFacilities($companyId);
                                    echo count($facilities);
                                    foreach ($facilities as $facility) { //format each list item
                                        ?><option value=<?php echo $facility->facility_id;?> <?php if($facility->facility_id == $employee->facility_id){echo("selected");}?>><?php echo $facility->address;?></option>
                                    <?php
                                    }
                                    ?>
                                </select><br>
                            </div>
                            <div class="form-group" align="left">
                                <input type="submit" value="Submit" name="move_modal_submit" class="btn btn-primary">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
    <?php
    }
    ?>
<hr>

<a id="home" href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Home</a>