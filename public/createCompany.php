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
        <?php require_once(dirname(__FILE__) . '/../scripts/views/navBarView.php'); ?>

        <div class="container-fluid">
            <?php require_once(dirname(__FILE__) . '/../scripts/views/displayError.php'); ?>

            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <?php require_once(dirname(__FILE__).'/../scripts/views/createCompanyView.php'); ?>
                </div>
            </div>
        </div>

        <?php require_once(dirname(__FILE__) . '/../scripts/views/footerView.php'); ?>
    </body>
</html>

