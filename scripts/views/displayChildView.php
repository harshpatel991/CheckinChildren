<?php

require_once(dirname(__FILE__).'/../cookieManager.php');
require_once(dirname(__FILE__).'/../models/dao/childDAO.php');
require_once(dirname(__FILE__).'/../models/childModel.php');
require_once(dirname(__FILE__).'/../dateTimeProvider.php');
require_once(dirname(__FILE__).'/../models/childStatusEnum.php');
require_once(dirname(__FILE__).'/../models/facilityModel.php');
require_once(dirname(__FILE__) . '/../controllers/facilityController.php');
require_once(dirname(__FILE__).'/../models/dao/facilityDAO.php');

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
    <?php if ($_COOKIE[cookieManager::$userRole]=='Parent') { ?>
    <a class="btn btn-success" name="edit_child" href="editChild.php?child_id=<?php echo $_GET['child_id']; ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit This Child</a>
    <hr>
    <a class="btn btn-primary" id="my_children" href="displayChildren.php"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back to My Children</a>

    <?php
    } else { ?>
        <a class="btn btn-success confirm-submit" data-toggle="modal" data-target="#confirmModal"id="move_child"><span class="glyphicon glyphicon-move" aria-hidden="true"></span>Move</a>
        <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="confirmModalLabel">Move Child</h4>
                </div>
                <div class="modal-body">
                    <?php
                        $facilityDAO = new facilityDAO();
                        $facility = $facilityDAO->find($child->facility_id);
                    ?>
                    <table>
                    <tr>
                        <th><u> Current Facility</u></th>
                    </tr>
                    <tr>
                        <th>ID:</th>
                        <td><?php echo $child->facility_id; ?></td>
                    </tr>
                    <tr>
                        <th>Address:</th>
                        <td><?php echo $facility->address; ?></td>
                    </tr>
                        </table>
                </div>
                <div class="modal-footer">
                    <form method="post" action="../scripts/controllers/form_handlers/moveChildFormHandler.php?child_id=<?php echo $_GET['child_id']; ?>">
                        <div class="form-group" align="left">
                            <select  id="facility_id" name="facility_id">
                                <?php
                                $facilityController = new facilityController();
                                $companyId = $_COOKIE[cookieManager::$userId];
                                $facilities = $facilityController->getAllFacilities($companyId);
                                echo count($facilities);
                                foreach ($facilities as $facility) { //format each list item
                                    ?><option value=<?php echo $facility->facility_id;?> <?php if($facility->facility_id == $child->facility_id){echo("selected");}?>><?php echo $facility->address;?></option>
                                <?php
                                }
                                ?>
                            </select><br>
                        </div>
                        <div class="form-group" align="left">
                        <input type="submit" value="Submit" name="move_modal_submit" class="btn btn-primary">
                        </div>
                    </form>
                </div>

            </div>
        </div>

    <?php } ?>
    <?php } else { ?>
    <h1>Child ID Not Set!</h1>
<?php
}
?>