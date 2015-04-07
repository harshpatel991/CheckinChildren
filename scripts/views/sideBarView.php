<?php
/**
 * This class determines what gets shown on the side bar based on the user's role.
 */
 require_once(dirname(__FILE__).'/../cookieManager.php'); ?>

<ul class="list-group">
    <a href="index.php" class="list-group-item"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>

    <?php if ($_COOKIE[cookieManager::$userRole]=='manager') { ?>
        <a href="displayEmployees.php" name="view_employees" class="list-group-item"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View My Employees</a>
        <a href="createEmployee.php" name="create_employees" class="list-group-item"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Create Employee</a>
        <a href="displayLogs.php" name="display_logs" class="list-group-item"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span> View Logs</a>
        <?php employeeSideBar(); //include the employees side bar items ?>
    <?php } else if ($_COOKIE[cookieManager::$userRole]=='employee') {
        employeeSideBar();
    } else if ($_COOKIE[cookieManager::$userRole]=='company') { ?>
        <a href="displayFacilities.php" name="view_facilities" class="list-group-item"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View My Facilities</a>
        <a href="createFacility.php" name="create_facilities" class="list-group-item"><span class="glyphicon glyphicon-plus-sign"" aria-hidden="true"></span> Create A Facility</a></li>
        <a href="displayManagers.php" name="view_managers" class="list-group-item"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View My Managers</a></li>
        <a href="createManager.php" name="create_managers" class="list-group-item"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Create A Manager</a></li>
    <?php } else if ($_COOKIE[cookieManager::$userRole]=='parent') { ?>
        <a href="displayParentInfo.php" name="view_parent_profile" class="list-group-item"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> My Profile</a></li>
        <a href="displayChildren.php" id="view_my_children" class="list-group-item"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> My Children</a></li>
    <?php } ?>
</ul>

<?php
//Items for the side bar for employees and managers
function employeeSideBar() { ?>
    <a href="checkinChildren.php" name="view_children" class="list-group-item"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View Children</a>
    <a href="createParent.php" name="create_parent" class="list-group-item"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Create Parent</a>
    <a href="createChild.php" name="create_child" class="list-group-item"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Create Child</a>
    <a href="editEmployee.php" name="edit_employee" id="edit_employee" class="list-group-item"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Profile</a>
<?php } ?>