<?php
/**
 * Creates a template to load in the page for the editing of children as viewed by parents
 */

error_reporting(E_ALL); //turn on error reporting
ini_set("display_errors", 1);

require_once(dirname(__FILE__).'/../scripts/controllers/authController.php');

$authController = new authController();
if (false == $authController->verifyRole(['parent'])){
    header("Location: index.php?error=".errorEnum::permission_view_error);
    exit();
}
else if (!isset($_GET['child_id']) || false == $authController->verifyChildPermissions($_GET['child_id'])){
    header("Location: displayChildren.php?error=".errorEnum::invalid_child);
    exit();
}
else {
    $authController->redirectPage();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <?php require_once(dirname(__FILE__).'/importBoostrap.php'); ?>
        <script src="js/moment.js"></script>
        <script src="js/combodate.js"></script>
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
                    <?php require_once(dirname(__FILE__).'/../scripts/views/editChildView.php'); ?>
                </div>
            </div>
        </div>

        <?php require_once(dirname(__FILE__) . '/../scripts/views/footerView.php'); ?>
    </body>
</html>

