<?php

require_once(dirname(__FILE__).'/../cookieManager.php');
require_once(dirname(__FILE__).'/../models/dao/childDAO.php');
require_once(dirname(__FILE__).'/../models/childModel.php');
require_once(dirname(__FILE__).'/../dateTimeProvider.php');
require_once(dirname(__FILE__).'/../models/childStatusEnum.php');

$childDAO = new childDAO();

if(isset($_GET['child_id'])) {
    $child = $childDAO->find($_GET['child_id']);
    ?>

    <h1> Child Profile</h1>
    <table class="table">
        <tr>
            <th>Name</th>
            <td><?php echo $child->child_name; ?></td>
        </tr>
        <tr>
            <th>Facility</th>
            <td><?php echo $child->facility_id; ?></td>
        </tr>
        <tr>
            <th>Allergies</th>
            <td><?php echo $child->allergies; ?></td>
        </tr>
        <tr>
            <th>Trusted Parties</th>
            <td><?php echo $child->trusted_parties; ?></td>
        </tr>
        <tr>
            <th>Child Status</th>
            <td><?php echo '<img src="../images/childStatus/'.$child->getStatus().'.gif"> '.childStatus::getInfo($child->getStatus()); ?></td>
        </tr>
    </table>


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

    <a class="btn btn-success" name="edit_child" href="editChild.php?child_id=<?php echo $_GET['child_id']; ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit This Child</a>
    <hr>
    <a class="btn btn-primary" id="my_children" href="displayChildren.php"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back to My Children</a>

<?php } else { ?>
    <h1>Child ID Not Set!</h1>
<?php
}
?>