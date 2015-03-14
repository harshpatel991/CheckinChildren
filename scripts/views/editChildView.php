<?php

require_once(dirname(__FILE__).'/../models/dao/childDAO.php');
require_once(dirname(__FILE__).'/../models/childModel.php');

$childDAO=new childDAO();
$child=$childDAO->find($_GET['child_id']);
?>

<form method="post" action="../scripts/controllers/form_handlers/editChildFormHandler.php">
    <div class="form-group">
        <label for="child_name">Name</label>
        <input type="text" name="child_name" id="child_name" value="<?php echo $child->child_name; ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="allergies">Allergies</label>
        <input type="text" name="allergies" id="allergies" value="<?php echo $child->allergies; ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="trusted_parties">Trusted Parties</label>
        <input type="text" name="trusted_parties" id="trusted_parties" value="<?php echo $child->trusted_parties; ?>" class="form-control">
    </div>

    <input type="hidden" name="child_id" id="child_id" value="<?php echo $_GET['child_id']; ?>">

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Day</th>
            <th>Checkin</th>
            <th>Checkout</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
        $ci = $child->expectCheckinReadable();
        $co = $child->expectCheckoutReadable();
        for ($i=0; $i<7; $i++){
        ?>
        <tr>
            <td><?php echo $days[$i]; ?></td>
            <td><input class="time-picker" type="text"data-format="h:mm a" data-template=" hh : mm a"
                       name="ci-<?php echo $i; ?>" value="<?php echo $ci[$i]; ?>"></td>
            <td><input class="time-picker" type="text" data-format="h:mm a" data-template=" hh : mm a"
                       name="co-<?php echo $i; ?>" value="<?php echo $co[$i]; ?>"></td>
        </tr>
        <?php }?>
        </tbody>
    </table>


    <input type="submit" value="Submit" name="submit" class="btn btn-primary">
</form>

<hr>

<a id="home" href="displayChild.php?child_id=<?php echo $_GET['child_id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back to Child Info</a>


<script>
    $(document).ready(function(){
        $('.time-picker').combodate();
    });
</script>