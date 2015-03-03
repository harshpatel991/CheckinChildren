<?php
error_reporting(E_ALL); //turn on error reporting
ini_set("display_errors", 1);
?>

<!DOCTYPE html>
<html>
    <head>
        <?php require_once(dirname(__FILE__).'/importBoostrap.php'); ?>
    </head>

    <body>
        <h1>Bad Authentication</h1>
        <h3>Try logging in again.</h3>
        <a href="login.php">Login</a>
    </body>
</html>

