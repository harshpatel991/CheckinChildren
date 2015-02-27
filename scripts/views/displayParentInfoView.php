<?php
error_reporting(E_ALL);
ini_set("display_errors",1);

    require_once(dirname(__FILE__).'/../controllers/authController.php');
    require_once(dirname(__FILE__).'/../models/dao/parentDAO.php');
    require_once(dirname(__FILE__).'/../models/parentModel.php');

    $parentDAO=new parentDAO();
    $parent=$parentDAO->find($_COOKIE[cookieManager::$userId]);

?>

<h3>Account Profile</h3>
<table border="1">
    <tr>
        <td>Name</td>
        <td><?php echo $parent->parent_name; ?></td>
    </tr>
    <tr>
        <td>Address</td>
        <td><?php echo $parent->address; ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php echo $parent->email; ?></td>
    </tr>
    <tr>
        <td>Phone Number</td>
        <td><?php echo $parent->phone_number; ?></td>
    </tr>
</table>
<a href="">Edit Information</a><br>
<a href="">Change Password</a><br>

