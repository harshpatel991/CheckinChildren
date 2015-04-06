<?php

require_once(dirname(__FILE__).'/../cookieManager.php');
require_once(dirname(__FILE__) . '/../controllers/facilityController.php');
require_once(dirname(__FILE__).'/../models/facilityModel.php');
require_once(dirname(__FILE__).'/../models/facilityModel.php');
require_once(dirname(__FILE__).'/../models/dao/employeeDao.php');
require_once(dirname(__FILE__).'/../models/dao/childDao.php');

if(isset($_GET['facility_id'])) { //check if a GET has been set

    $facilityController = new facilityController();
    $facility = $facilityController->getFacility($_GET['facility_id']);

    if($_COOKIE[cookieManager::$userId] == $facility->company_id) { //check the facility belongs to the company
        displaySingleFacility($facility);
    } else {
        displayAllFacilities('Facility does not belong to your company!');
    }
} else {
    displayAllFacilities();
}

//Show a single facility
function displaySingleFacility($facility) {
?>
    <h3>Facility ID: <?php echo $facility->facility_id; ?></h3>
    <p>
        Company ID: <?php echo $facility->company_id; ?> <br>
        Address: <?php echo $facility->address; ?> <br>
        Phone: <?php echo $facility->phone; ?> <br>

        <br>
        <a class="btn btn-success" id="edit_parent" href="editFacility.php"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Information</a>
        <a class="btn btn-danger confirm-submit" data-toggle="modal" data-target="#confirmModal"id="delete_facility"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> Remove Facility</a>

        <hr>
        <a href="displayFacilities.php" class="btn btn-success"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> View all facilities</a>
    </p>
<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="confirmModalLabel">Confirm Facility Removal</h4>
            </div>
            <div class="modal-body">
                <?php
                $childDao = new childDAO();
                $employeeDao = new employeeDAO();
                $children = $childDao->findChildrenInFacility($facility->facility_id);
                $employees = $employeeDao->getFacilityEmployees($facility->facility_id);
                $numChildren = count($children);
                $numEmployees = count($employees);
                ?>
                <p id="modal-ci-number">You are about to remove the following facility:</p>
                Facility ID: <?php echo $facility->facility_id; ?><br>
                Address: <?php echo $facility->address; ?> <br>
                Phone: <?php echo $facility->phone; ?> <br>
                <br>
                <p id="modal-co-number">Removing this facility will also remove:</p>
                <ul id="ci-list">
                    <li><?php echo $numEmployees; if($numEmployees == 1){echo " Employee";}else {echo " Employees";} ?></li>
                    <li><?php echo $numChildren;  if($numChildren == 1){echo " Child";}else {echo " Children";}?></li>
                </ul>
            </div>
            <div class="modal-footer">
                <form name="deleteFacilityForm" method="post" action="../scripts/controllers/form_handlers/deleteFacilityFormHandler.php">
                    <input id="facility_id" value="<?php $facility->facility_id; ?>" type="hidden">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="modal-submit" type="submit" class="btn btn-primary">Confirm Removal</button>
                </form>
            </div>

        </div>
    </div>
<?php

}

//Display a list of all facilities
//@param errorMessage The error message to display, if there is one
function displayAllFacilities($errorMessage = '') {
    $facilityController = new facilityController();
    $companyId = $_COOKIE[cookieManager::$userId];
    $facilities = $facilityController->getAllFacilities($companyId);

    $facilityList = '';
    foreach ($facilities as $facility) { //format each list item
        $facilityList .= '<a href="?facility_id=' . $facility->facility_id . '">' . $facility->address . '</a><br>'; //add on to the list
    }
    ?>

    <h1 id="title">My Facilities</h1>

        <?php echo $facilityList; ?>

    <br>
    <a class="btn btn-success" href="createFacility.php" name="new_facility"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New Facility</a>
    <hr>
    <a id="home" name="home" href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Home</a>



<?php
}?>


