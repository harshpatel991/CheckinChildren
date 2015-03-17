<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/16/15
 * Time: 10:05 PM
 */
error_reporting(E_ALL); //turn on error reporting
ini_set("display_errors", 1);

require_once(dirname(__FILE__).'/../scripts/controllers/authController.php');
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
        <div class="col-sm-2 col-sm-offset-2">
            <?php require_once(dirname(__FILE__) . '/../scripts/views/sideBarView.php'); ?>
        </div>
        <div class="col-sm-6">
            <?php require_once(dirname(__FILE__).'/../scripts/views/displayEmployeeView.php'); ?>
        </div>
    </div>
</div>

<?php require_once(dirname(__FILE__) . '/../scripts/views/footerView.php'); ?>
</body>
</html>

