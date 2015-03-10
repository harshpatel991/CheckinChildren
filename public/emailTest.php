<?php
error_reporting(E_ALL); //turn on error reporting
ini_set("display_errors", 1);

?>

<!DOCTYPE html>
<html>
<head>
    <?php require_once(dirname(__FILE__).'/importBoostrap.php'); ?>
    <script src="js/moment.js"></script>
    <script src="js/combodate.js"></script>
</head>

<body>
<form method="post" action="../scripts/controllers/form_handlers/emailTestFormHandler.php">
    To:
    <input type="text" name="to" value="mwallick@hotmail.com"><br>
    Subject:
    <input type="text" name="subj" value="Hello from CheckinChildren"><br>
    Message:
    <input type="text" name="msg" value="Test email. If you received this in error, please disregard."><br>
    <input type="submit">
</form>
</body>
</html>
