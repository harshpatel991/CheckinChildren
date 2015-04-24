<?php
/**
 * Takes the error code for a particular page and displays the actual error
 */
?>
<?php require_once(dirname(__FILE__).'/../errorManager.php'); ?>


<?php if(isset($_GET['error'])) { ?>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="alert alert-danger" id="error_message" role="alert">
                <?php echo errorManager::getErrorMessage($_GET['error']); ?>
            </div>
        </div>
    </div>
<?php } ?>
