<?php
/**
 * The view that contains the html that one sees when viewing a particular child's profile
 * Depending on the user, it contains links to edit or delete the child's profile
 * and move the child to a different facility
 */
require_once(dirname(__FILE__).'/../cookieManager.php');
require_once(dirname(__FILE__).'/../models/dao/childDAO.php');
require_once(dirname(__FILE__).'/../models/dao/logDAO.php');
require_once(dirname(__FILE__).'/../models/childModel.php');
require_once(dirname(__FILE__).'/../dateTimeProvider.php');
require_once(dirname(__FILE__).'/../models/childStatusEnum.php');
require_once(dirname(__FILE__).'/../models/facilityModel.php');
require_once(dirname(__FILE__) . '/../controllers/facilityController.php');
require_once(dirname(__FILE__).'/../models/dao/facilityDAO.php');

$childDAO = new childDAO();
$logDao = new logDAO();

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


    <div class="panel panel-default">
        <div class="panel-heading">
            <h4  data-toggle="collapse" data-target="#timesPanel" aria-expanded="true" class="">Checkin/Out Times</h4>
        </div>
        <div id="timesPanel" class="panel-collapse collapse" aria-expanded="true">
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
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4  data-toggle="collapse" data-target="#historyPanel" aria-expanded="true" class="">History</h4>
        </div>
        <div id="historyPanel" class="panel-collapse collapse" aria-expanded="true">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Event</th>
                    <th>Employee</th>
                    <th>Care Of</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $childEvents = $logDao->getChildHistory($child->child_id, 10);
                foreach ($childEvents as $event){
                    $dateTime = dateTimeProvider::getdate($event->time_created);
                    ?>
                    <tr>
                        <td><?php echo dateTimeProvider::readableDate($dateTime); ?></td>
                        <td><?php echo dateTimeProvider::readableTime($dateTime, false); ?></td>
                        <td><?php echo $event->transaction_type; ?></td>
                        <td><?php echo $event->primary_name; ?></td>
                        <td><?php echo $event->additional_info; ?></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    $minutes=$child->parent_late_minutes;
    ?>
    <?php if ($_COOKIE[cookieManager::$userRole]=='parent') { ?>
    <a class="btn btn-success" name="edit_child" href="editChild.php?child_id=<?php echo $_GET['child_id']; ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit This Child</a>
    <br><br>
    <form method="post" action="../scripts/controllers/form_handlers/lateMinutesFormHandler.php">
        I will be
        <select name="minutes" id="minutes">
            <?php for ($i=0; $i<7; $i++){
                $fift=$i*15;
                $str="";
                if ($minutes==$fift){
                    $str=" selected";
                }
                echo '<option value='.$fift.$str.'>'.$fift.'</option>';
            }?>
<!--            <option value=0 --><?php //if($minutes ==0) echo 'selected';?><!-->0</option>-->
<!--            <option value=15 --><?php //if($minutes ==15) echo 'selected';?><!-->15</option>-->
<!--            <option value=30 --><?php //if($minutes ==30) echo 'selected';?><!-->30</option>-->
<!--            <option value=45 --><?php //if($minutes ==45) echo 'selected';?><!-->45</option>-->
<!--            <option value=60 --><?php //if($minutes ==60) echo 'selected';?><!-->60</option>-->
<!--            <option value=75 --><?php //if($minutes ==75) echo 'selected';?><!-->75</option>-->
<!--            <option value=90 --><?php //if($minutes ==90) echo 'selected';?><!-->90</option>-->
        </select>
        minutes late to pick up my child today only.
        <input type="hidden" name="child_id" id="child_id" value=<?php echo $child->child_id;?>>
        <input type="submit" value="Confirm" name="submit" class="btn btn-primary">
    </form>
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