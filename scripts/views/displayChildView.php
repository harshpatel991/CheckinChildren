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

    <div class="container col-lg-offset-0">
        <h2>Times</h2>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Day</th>
                <th>Checkin</th>
                <th>Checkout</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
            $ci = $child->expectCheckinReadable();
            $co = $child->expectCheckoutReadable();
            for ($i=0; $i<7; $i++){
                ?>
                <tr>
                    <td><?php echo $days[$i]; ?></td>
                    <td><?php echo $ci[$i]; ?></td>
                    <td><?php echo $co[$i]; ?></td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>

    <?php
    echo '<br><a href="editChild.php?child_id=' . $_GET['child_id'] . '">Edit This Child</a>';
    echo '<br><a href="displayChildren.php">Back to my children</a>';

} else {
    echo "Child ID not set";
}