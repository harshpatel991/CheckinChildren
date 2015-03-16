<?php
require_once(dirname(__FILE__).'/../controllers/authController.php');
require_once(dirname(__FILE__).'/../models/dao/parentDAO.php');
require_once(dirname(__FILE__).'/../models/parentModel.php');
require_once(dirname(__FILE__).'/../models/carrierEnum.php');

$parentDAO=new parentDAO();
$parent=$parentDAO->find($_COOKIE[cookieManager::$userId]);

?>

<h1>Edit Account Profile</h1>
<form method="post" action="../scripts/controllers/form_handlers/editParentFormHandler.php">
    <div class="form-group">
        <label for="parent_name">Name</label>
        <input type="text" name="parent_name" id="parent_name" value="<?php echo $parent->parent_name; ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php echo $parent->email; ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" name="address" id="address" value="<?php echo $parent->address; ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="phone_number">Phone Number</label>
        <input type="text" name="phone_number" id="phone_number" value="<?php echo $parent->phone_number; ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="carrier">Carrier</label>
        <select id="carrier" name="carrier">
            <option value="">- Select your carrier -</option>
            <option value="<?php echo carrier::verizon?>"<?php if($parent->carrier == carrier::verizon){echo("selected");}?>><?php echo carrier::verizon?></option>
            <option value="<?php echo carrier::tmobile?>"<?php if($parent->carrier == carrier::tmobile){echo("selected");}?>><?php echo carrier::tmobile?></option>
            <option value="<?php echo carrier::att?>"<?php if($parent->carrier == carrier::att){echo("selected");}?>><?php echo carrier::att?></option>
            <option value="<?php echo carrier::boost?>"<?php if($parent->carrier == carrier::boost){echo("selected");}?>><?php echo carrier::boost?></option>
            <option value="<?php echo carrier::sprint?>"<?php if($parent->carrier == carrier::sprint){echo("selected");}?>><?php echo carrier::sprint?></option>
            <option value="<?php echo carrier::us?>"<?php if($parent->carrier == carrier::us){echo("selected");}?>><?php echo carrier::us?></option>
            <option value="<?php echo carrier::virgin?>"<?php if($parent->carrier == carrier::virgin){echo("selected");}?>><?php echo carrier::virgin?></option>
        </select><br>
    </div>



    <div class="form-group">
        <?php $contact=$parent->contact_pref;?>

        <label for="texting">Receive Texts:&nbsp;&nbsp;&emsp;</label><input type="checkbox" <?php if (strpos($contact, "text")!==false) echo "checked";?> name="texting" id="texting" value="text"> <br />
        <label for="emailing">Receive Emails:&emsp;</label><input type="checkbox" <?php if (strpos($contact, "email")!==false) echo "checked";?> name="emailing" id="emailing" value="email">
    </div>

    <input type="submit" value="Submit" name="submit" class="btn btn-primary">
</form>

<hr>

<a id="home" href="displayParentInfo.php" class="btn btn-danger"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back to Account Profile</a>
