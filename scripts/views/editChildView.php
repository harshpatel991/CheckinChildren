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


    <div class="container col-lg-offset-0">
        <h2>Times</h2>
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
            var_dump($ci);
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
    </div>

    <input type="submit" value="Submit" name="submit">
</form>

<script>
    $(document).ready(function(){
        $('.time-picker').combodate();
    });
</script>