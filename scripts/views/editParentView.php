<?php
require_once(dirname(__FILE__).'/../controllers/authController.php');
require_once(dirname(__FILE__).'/../models/dao/parentDAO.php');
require_once(dirname(__FILE__).'/../models/parentModel.php');
require_once(dirname(__FILE__).'/../models/carrierEnum.php');

$parentDAO=new parentDAO();
$parent=$parentDAO->find($_COOKIE[cookieManager::$userId]);

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

<form method="post" action="../scripts/controllers/form_handlers/editParentFormHandler.php">
    Name:
    <input type="text" name="parent_name" value="<?php echo $parent->parent_name; ?>" > <br>
    Email:
    <input type="text" name="email" value="<?php echo $parent->email; ?>"><br>
    Address:
    <input type="text" name="address" value="<?php echo $parent->address; ?>"> <br>
    Phone number:
    <input type="text" name="phone_number" value="<?php echo $parent->phone_number; ?>">
    <select name="carrier">
        <option value="">- Select your carrier -</option>
        <option value="<?php echo carrier::verizon?>"<?php if($parent->carrier == carrier::verizon){echo("selected");}?>><?php echo carrier::verizon?></option>
        <option value="<?php echo carrier::tmobile?>"<?php if($parent->carrier == carrier::tmobile){echo("selected");}?>><?php echo carrier::tmobile?></option>
        <option value="<?php echo carrier::att?>"<?php if($parent->carrier == carrier::att){echo("selected");}?>><?php echo carrier::att?></option>
        <option value="<?php echo carrier::boost?>"<?php if($parent->carrier == carrier::boost){echo("selected");}?>><?php echo carrier::boost?></option>
        <option value="<?php echo carrier::sprint?>"<?php if($parent->carrier == carrier::sprint){echo("selected");}?>><?php echo carrier::sprint?></option>
        <option value="<?php echo carrier::us?>"<?php if($parent->carrier == carrier::us){echo("selected");}?>><?php echo carrier::us?></option>
        <option value="<?php echo carrier::virgin?>"<?php if($parent->carrier == carrier::virgin){echo("selected");}?>><?php echo carrier::virgin?></option>
    </select><br>

    <input type="submit" value="Submit" name="submit">
</form>


