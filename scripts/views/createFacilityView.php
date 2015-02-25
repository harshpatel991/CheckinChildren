<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Create Day Care Facility</title>
</head>
<body>
<p style="color:red">
<?php
    if(isset($_GET['error'])) {
        if($_GET['error'] == 1) {
            echo "Invalid Information";
        }
    }
?>
</p>
<form method="POST" action="../scripts/controllers/createFacilityController.php">
    Facility address:
    <input type="text" name="address"> <br>
    Phone number:
    <input type="text" name="phone_number"> <br>

    <input type="submit" name="submit" value="Submit">
</form>

</body>
</html>


