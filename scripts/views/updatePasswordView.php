<?php
//require_once(dirname(__FILE__).'/../controllers/authController.php');
?>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<p style="color:red">
    <?php
    if(isset($_GET['error'])) {
        if($_GET['error'] == 1) {
            echo "Incorrect old password or new password didn't match";
        }
    }
    ?>
</p>
<form method="post" action="../scripts/controllers/form_handlers/updatePasswordFormHandler.php">
    Old Password: <input type="password" name="old_gitpassword"> <br>
    New Password: <input type="password" name="new_password"> <br>
    Confirm Password: <input type="password" name="con_password"> <br>
    <input type="submit" name="submit" value="Submit">
</form>
</body>
</html>