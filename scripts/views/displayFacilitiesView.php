<?php

require_once(dirname(__FILE__).'/../cookieManager.php');
require_once(dirname(__FILE__) . '/../controllers/facilityController.php');
require_once(dirname(__FILE__).'/../models/facilityModel.php');


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
        <a href="displayFacilities.php">View all facilities</a>
    </p>
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

    <h3><a class="btn btn-success" href="createFacility.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New Facility</a></h3>
    <hr>
    <h3><a id="home" href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Home</a></h3>



<?php
}
