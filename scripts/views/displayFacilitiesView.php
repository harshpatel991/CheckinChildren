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
    $facilityTemplate = file_get_contents(dirname(__FILE__) . '/../../html/displayFacility.html');
    $facilityTemplate = str_replace("FACILITY_ID", $facility->facility_id, $facilityTemplate);
    $facilityTemplate = str_replace("COMPANY_ID", $facility->company_id, $facilityTemplate);
    $facilityTemplate = str_replace("FACILITY_ADDRESS", $facility->address, $facilityTemplate);
    $facilityTemplate = str_replace("FACILITY_PHONE", $facility->phone, $facilityTemplate);

    echo $facilityTemplate;
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

    $template = file_get_contents(dirname(__FILE__) . '/../../html/displayFacilities.html');
    $template = str_replace("FACILITY_LIST", $facilityList, $template);
    $template = str_replace("ERROR_MESSAGE", $errorMessage, $template);

    echo $template;
}
