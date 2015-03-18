<?php
//require_once(dirname(__FILE__).'/../controllers/authController.php');
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

<a id="home" href="displayParentInfo.php" class="btn btn-danger"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back to Account Profile</a>


