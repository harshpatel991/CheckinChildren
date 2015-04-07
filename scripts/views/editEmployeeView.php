<?php
require_once(dirname(__FILE__).'/../controllers/authController.php');
require_once(dirname(__FILE__).'/../models/dao/employeeDAO.php');
require_once(dirname(__FILE__).'/../models/parentModel.php');
require_once(dirname(__FILE__).'/../models/carrierEnum.php');

$employeeDAO=new employeeDAO();
$employee=$employeeDAO->find($_COOKIE[cookieManager::$userId]);

?>

<h1>Edit Account Profile</h1>
<form method="post" action="../scripts/controllers/form_handlers/editEmployeeFormHandler.php">
    <div class="form-group">
        <label for="parent_name">Name</label>
        <input type="text" name="employee_name" id="employee_name" value="<?php echo $employee->emp_name; ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php echo $employee->email; ?>" class="form-control">
    </div>

    <input type="submit" value="Submit" name="submit" class="btn btn-primary">
</form>

<hr>

<a id="home" href="index.php" class="btn btn-danger"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Home</a>
