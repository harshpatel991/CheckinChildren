<?php
require_once(dirname(__FILE__).'/../controllers/authController.php');
require_once(dirname(__FILE__).'/../models/dao/parentDAO.php');
require_once(dirname(__FILE__).'/../models/parentModel.php');

$parentDao = new parentDAO();
$parents = $parentDao->findAll();
?>

<h1>Create Child</h1>
<form method="post" action="../scripts/controllers/form_handlers/createChildFormHandler.php">
    <div class="form-group">
        <label for="name">Child Name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>

    <div class="form-group">
        <label for="aller">Allergies</label>
        <input type="text" name="aller" id="aller" class="form-control">
    </div>
    <div class="form-group">
        <label for="trusted_parties">Trusted Parties</label>
        <input type="text" name="trusted_parties" id="trusted_parties" class="form-control">
    </div>
    <div class="form-group">
        <label for="PID">Parent</label><br>
        <select class="select2-search--dropdown select2-parent" name="PID" id="PID" style="width: 100%">
            <option disabled selected></option>

            <?php
            foreach($parents as $parent) {
                echo '<option value="'.$parent->id.'">'.$parent->parent_name.' ('.$parent->email.')</option>';
            }
            ?>

        </select>
    </div>


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
        for ($i=0; $i<7; $i++){
            ?>
            <tr>
                <td><?php echo $days[$i]; ?></td>
                <td><input class="time-picker" type="text"data-format="h:mm a" data-template=" hh : mm a"
                           name="ci-<?php echo $i; ?>" ></td>
                <td><input class="time-picker" type="text" data-format="h:mm a" data-template=" hh : mm a"
                           name="co-<?php echo $i; ?>"></td>
            </tr>
        <?php }?>
        </tbody>
    </table>
    <input class="btn btn-primary" type="submit" name="submit" value="Submit">
</form>

<hr>

<a class="btn btn-danger" id="home" href="index.php"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back to Home</a>


<script>
    $(document).ready(function(){
        $('.time-picker').combodate();
        $('.select2-parent').select2({
            placeholder: "Select parent",
            allowClear: true
        });
    });
</script>

