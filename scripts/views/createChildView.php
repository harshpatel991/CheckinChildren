<h1>Create Child</h1>
<form method="post" action="../scripts/controllers/form_handlers/createChildFormHandler.php">
    <div class="form-group">
        <label for="name">Child Name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <div class="form-group">
        <label for="PID">Parent ID</label>
         <input type="text" name="PID" id="PID" class="form-control">
    </div>
    <div class="form-group">
        <label for="aller">Allergies</label>
        <input type="text" name="aller" id="aller" class="form-control">
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
    });
</script>

