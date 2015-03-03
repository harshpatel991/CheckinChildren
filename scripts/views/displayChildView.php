<?php

require_once(dirname(__FILE__).'/../cookieManager.php');
require_once(dirname(__FILE__).'/../models/dao/childDAO.php');
require_once(dirname(__FILE__).'/../models/childModel.php');

$childDAO = new childDAO();

if(isset($_GET['child_id'])) {
    $child = $childDAO->find($_GET['child_id']);
    ?>

    <h3> Child Profile</h3>
    <table border="1">
        <tr>
            <td>Name</td>
            <td><?php echo $child->child_name; ?></td>
        </tr>
        <tr>
            <td>Facility</td>
            <td><?php echo $child->facility_id; ?></td>
        </tr>
        <tr>
            <td>Allergies</td>
            <td><?php echo $child->allergies; ?></td>
        </tr>
    </table>

    <?php
    echo '<br><a href="editChild.php?child_id=' . $_GET['child_id'] . '">Edit This Child</a>';
    echo '<br><a href="displayChildren.php">Back to my children</a>';

} else {
    echo "Child ID not set";
}