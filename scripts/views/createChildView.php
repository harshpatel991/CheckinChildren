<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
if(isset($_GET['error'])) {
    if($_GET['error'] == 1) {
        echo "Invalid information";
    }
}
?>
<form method="post" action="../scripts/controllers/form_handlers/createChildFormHandler.php">
    Child Name: <input type="text" name="name" > <br>
    Parent ID: <input type="text" name="PID"> <br>
    Allergies: <input type="text" name="aller"><br>

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
    </div>
    <input type="submit" name="submit" value="Submit">
</form>

<script>
    $(document).ready(function(){
        $('.time-picker').combodate();
    });
</script>

</body>
</html>