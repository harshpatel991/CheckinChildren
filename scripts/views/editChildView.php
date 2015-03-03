<?php

require_once(dirname(__FILE__).'/../models/dao/childDAO.php');
require_once(dirname(__FILE__).'/../models/childModel.php');

$childDAO=new childDAO();
$child=$childDAO->find($_GET['child_id']);
?>
<p style="color:red">
    <?php
    if(isset($_GET['error'])) {
        if($_GET['error'] == 1) {
            echo "Invalid Information";
        }
    }
    ?>
</p>

<form method="post" action="../scripts/controllers/form_handlers/editChildFormHandler.php">
Name:
    <input type="text" name="child_name" value="<?php echo $child->child_name; ?>"> <br>
Allergies:
    <input type="text" name="allergies" value="<?php echo $child->allergies; ?>"><br>

    <input type="hidden" name="child_id" value="<?php echo $_GET['child_id']; ?>">
    <input type="submit" value="Submit" name="submit">
</form>