<?php
/**
 * This class displays the necessary components to change one's password
 */
//require_once(dirname(__FILE__).'/../controllers/authController.php');
  require_once(dirname(__FILE__).'/../cookieManager.php');
?>

<h1>Change Password</h1>
<form method="post" action="../scripts/controllers/form_handlers/updatePasswordFormHandler.php">

    <div class="form-group">
        <label for="old_password">Old Password</label>
        <input type="password" name="old_password" id="old_password" class="form-control">
    </div>

    <div class="form-group">
        <label for="new_password">New Password</label>
        <input type="password" name="new_password" id="new_password" class="form-control">
    </div>

    <div class="form-group">
        <label for="con_password">Confirm Password</label>
        <input type="password" name="con_password" id="con_password" class="form-control">
    </div>

    <input type="submit" name="submit" value="Submit" class="btn btn-primary">

</form>

<hr>

<?php if ($_COOKIE[cookieManager::$userRole]=='company') { ?>
    <a href="displayCompanyInfo.php" class="btn btn-success"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back to Account Profile</a>
<?php
} else if ($_COOKIE[cookieManager::$userRole]=='parent') { ?>
    <a href="displayParentInfo.php" class="btn btn-success"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back to Account Profile</a>
<?php
} else { ?>
    <a href="displayEmployeeInfo.php" class="btn btn-success"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back to Account Profile</a>
<?php } ?>

