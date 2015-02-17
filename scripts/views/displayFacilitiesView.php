<?php

require_once(dirname(__FILE__).'/../cookieManager.php');
require_once(dirname(__FILE__) . '/../controllers/facilityController.php');
require_once(dirname(__FILE__).'/../models/facilityModel.php');

$facilityController = new facilityController();

if(isset($_GET['facility_id'])) { //check if a GET has been set

    $facility = $facilityController->getFacility($_GET['facility_id']);

    $facilityTemplate = file_get_contents (dirname(__FILE__).'/../../html/displayFacility.html');
    $facilityTemplate = str_replace("FACILITY_ID", $facility->facility_id, $facilityTemplate);
    $facilityTemplate = str_replace("COMPANY_ID", $facility->company_id, $facilityTemplate);
    $facilityTemplate = str_replace("FACILITY_ADDRESS", $facility->address, $facilityTemplate);
    $facilityTemplate = str_replace("FACILITY_PHONE", $facility->phone, $facilityTemplate);

    echo $facilityTemplate;

} else { //otherwise print out entire list of facilities

    $companyId = $_COOKIE[cookieManager::$userId];
    $facilities = $facilityController->getAllFacilities($companyId);


    $facilityAddressList = '';
    foreach ($facilities as $facility) { //format each list item

        $facilityList .=  '<a href="?facility_id='. $facility->facility_id .'">'.$facility->address . '</a><br>'; //add on to the list
    }

    $template = file_get_contents(dirname(__FILE__).'/../../html/displayFacilities.html');
    $template = str_replace("FACILITY_LIST", $facilityList, $template);
    echo $template;

}