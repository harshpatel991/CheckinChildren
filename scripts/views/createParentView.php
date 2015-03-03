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
<form method="post" action="../scripts/controllers/form_handlers/createParentFormHandler.php">
    parent Name: <input type="text" name="name" > <br>
    Parent Email: <input type="text" name="email"> <br>
    Parent Phone Number: <input type="text" name="phone"> <br>
    Parent Address: <input type="text" name="addr"><br>
    Parent Password: <input type="text" name="password"> <br>
    <input type="hidden" name="role" value="parent">
    <input type="submit" name="submit" value="Submit">
</form>
</body>
</html>
