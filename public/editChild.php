<?php
error_reporting(E_ALL); //turn on error reporting
ini_set("display_errors", 1);

require_once(dirname(__FILE__).'/../scripts/controllers/authController.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <?php require_once(dirname(__FILE__).'/importBoostrap.php'); ?>
        <script src="js/moment.js"></script>
        <script src="js/combodate.js"></script>
    </head>

    <body>
        <?php require_once(dirname(__FILE__).'/../scripts/views/editChildView.php'); ?>
    </body>
</html>

