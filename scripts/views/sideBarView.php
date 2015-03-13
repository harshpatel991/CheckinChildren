<?php require_once(dirname(__FILE__).'/../cookieManager.php'); ?>

<ul class="list-group">
    <a href="index.php" class="list-group-item"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>

    <?php if ($_COOKIE[cookieManager::$userRole]=='manager') { ?>
        <a href="displayEmployees.php" class="list-group-item"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View My Employees</a>
        <a href="createEmployee.php" class="list-group-item"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Create Employee</a>
    <?php employeeSideBar(); //include the employees side bar items also ?>

    <?php
    } else if ($_COOKIE[cookieManager::$userRole]=='employee') {
        employeeSideBar();
    } else if ($_COOKIE[cookieManager::$userRole]=='company') { ?>
        <a href="displayFacilities.php" class="list-group-item"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View My Facilities</a>
        <a href="createFacility.php" class="list-group-item"><span class="glyphicon glyphicon-plus-sign"" aria-hidden="true"></span> Create A Facility</a></li>
        <a href="displayManagers.php" class="list-group-item"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View My Managers</a></li>
        <a href="createManager.php" class="list-group-item"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Create A Manager</a></li>
    <?php } else if ($_COOKIE[cookieManager::$userRole]=='parent') { ?>
        <a href="displayParentInfo.php" class="list-group-item"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> My Profile</a></li>
        <a href="displayChildren.php" class="list-group-item"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> My Children</a></li>
    <?php } ?>

</ul>

<?php
//Items for the side bar for employees and managers
function employeeSideBar() { ?>
    <a href="checkinChildren.php" class="list-group-item"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View Children</a>
    <a href="createParent.php" class="list-group-item"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Create Parent</a>
    <a href="createChild.php" class="list-group-item"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Create Child</a>
<?php
}
?>