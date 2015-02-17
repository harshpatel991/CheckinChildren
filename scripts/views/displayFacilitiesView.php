<?php

require_once(dirname(__FILE__).'/../controllers/displayFacilitiesController.php');
require_once(dirname(__FILE__).'/../models/facilityModel.php');

$displayFacilitiesController = new displayFacilitiesController();

if(isset($_GET['facility_id'])) { //check if a GET has been set



} else {

    $companyId = 1; //TODO: replace with $_COOKIE[cookieManger::user_id]
    $facilities = $displayFacilitiesController->getAllFacilities($companyId);

    foreach ($facilities as $facility) { //print out each list item
        echo "hey";
        $htmlListTemplate = dirname(__FILE__).'/../../html/displayFacilityListItem.html';
        $template = file_get_contents ($htmlListTemplate);

        $template = str_replace("FACILITY_ID", $facility->facility_id, $template);
        $template = str_replace("COMPANY_ID", $facility->company_id, $template);
        $template = str_replace("FACILITY_ADDRESS", $facility->address, $template);
        $template = str_replace("FACILITY_PHONE", $facility->phone, $template);
        echo $template;
    }
}