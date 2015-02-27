<?php
require_once(dirname(__FILE__).'/../controllers/authController.php');
require_once(dirname(__FILE__).'/../models/dao/parentDAO.php');
require_once(dirname(__FILE__).'/../models/parentModel.php');

$parentDAO=new parentDAO();
$parent=$parentDAO->find($_COOKIE[cookieManager::$userId]);

?>


<form method="post" action="../scripts/controllers/form_handlers/editParentFormHandler.php">
    Name:
    <input type="text" name="parent_name" value="<?php echo $parent->parent_name; ?>" > <br>
    Email:
    <input type="text" name="email" value="<?php echo $parent->email; ?>"><br>
    Address:
    <input type="text" name="address" value="<?php echo $parent->address; ?>"> <br>
    Phone number:
    <input type="text" name="phone_number" value="<?php echo $parent->phone_number; ?>"> <br>

    <input type="hidden" name="role" value="parent">

    <input type="submit" value="Submit" name="submit">
</form>


