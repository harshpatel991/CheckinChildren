

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
require_once(dirname(__FILE__).'/../models/carrierEnum.php');
if(isset($_GET['error'])) {
    if($_GET['error'] == 1) {
        echo "Invalid information";
    }
}
?>
<form method="post" action="../scripts/controllers/form_handlers/createParentFormHandler.php">
    Parent Name: <input type="text" name="name" > <br>
    Parent Email: <input type="text" name="email"> <br>
    Parent Phone Number: <input type="text" name="phone">
    <select name="carrier">
        <option value="">- Select your carrier -</option>
        <option value="<?php echo carrier::verizon?>"><?php echo carrier::verizon?></option>
        <option value="<?php echo carrier::tmobile?>"><?php echo carrier::tmobile?></option>
        <option value="<?php echo carrier::att?>"><?php echo carrier::att?></option>
        <option value="<?php echo carrier::boost?>"><?php echo carrier::boost?></option>
        <option value="<?php echo carrier::sprint?>"><?php echo carrier::sprint?></option>
        <option value="<?php echo carrier::us?>"><?php echo carrier::us?></option>
        <option value="<?php echo carrier::virgin?>"><?php echo carrier::virgin?></option>
    </select><br>
    Parent Address: <input type="text" name="addr"><br>
    Parent Password: <input type="text" name="password"> <br>

    <input type="submit" name="submit" value="Submit">
</form>
</body>
</html>
