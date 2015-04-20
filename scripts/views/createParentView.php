<?php
/**
* The view that contains the html one sees when creating a parent
* It contains a form for inputs needed to construct a valid parent model
* The form submits to the createParentFormHandler
*/
?>


<h1>Create Parent</h1>


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
    <div class="form-group">
        <label for="name">Parent Name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>

    <div class="form-group">
        <label for="email">Parent Email</label>
        <input type="text" name="email" id="email" class="form-control">
    </div>

    <div class="form-group">
        <label for="phone">Parent Phone Number</label>
        <input type="text" name="phone" id="phone" class="form-control">
    </div>

    <div class="form-group">
        <label for="addr">Parent Address</label>
        <input type="text" name="addr" id="addr" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Parent Password</label>
        <input type="text" name="password" id="password" class="form-control">
    </div>
    <div class="form-group">
        <label for="carrier">Please select your carrier:</label>
        <select name="carrier" class="form-control">
            <option value="">- Select your carrier -</option>
            <option value="<?php echo carrier::verizon?>"><?php echo carrier::verizon?></option>
            <option value="<?php echo carrier::tmobile?>"><?php echo carrier::tmobile?></option>
            <option value="<?php echo carrier::att?>"><?php echo carrier::att?></option>
            <option value="<?php echo carrier::boost?>"><?php echo carrier::boost?></option>
            <option value="<?php echo carrier::sprint?>"><?php echo carrier::sprint?></option>
            <option value="<?php echo carrier::us?>"><?php echo carrier::us?></option>
            <option value="<?php echo carrier::virgin?>"><?php echo carrier::virgin?></option>
        </select><br>
    </div>
    <div class="form-group">
        <label for="texting">Receive Texts:&nbsp;&nbsp;&emsp;</label><input type="checkbox" name="texting" id="texting" value="text"> <br />
        <label for="emailing">Receive Emails:&emsp;</label><input type="checkbox" name="emailing" id="emailing" value="email">
    </div>

    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
</form>

