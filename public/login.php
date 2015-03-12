<?php
error_reporting(E_ALL); //turn on error reporting
ini_set("display_errors", 1);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <?php require_once(dirname(__FILE__).'/importBoostrap.php'); ?>
    </head>

    <?php require_once(dirname(__FILE__) . '/../scripts/views/navBarView.php'); ?>

    <body>
        <div class="container-fluid">
            <div class="row classroom">
                <div class="col-sm-12 col-lg-8 col-lg-offset-2">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-8 col-lg-offset-2">
                    <?php require_once(dirname(__FILE__).'/../scripts/views/loginView.php'); ?>
                </div>
            </div>
        </div>
    </body>

</html>

