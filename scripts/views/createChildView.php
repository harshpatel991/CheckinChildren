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
    <input type="submit" name="submit" value="Submit">
</form>
</body>
</html>