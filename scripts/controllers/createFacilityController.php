<?php

require_once(dirname(__FILE__).'/../models/dao/facilityDAO.php');

//Read in POST data from form

$facility = new facilityModel($_POST['company_id'], $_POST['address'], $_POST['phone_number']);

if ($facility->isValid()) {
    $facilityDAO = new FacilityDAO();
    $facility_id = $facilityDAO->insert($facility);

    header("Location: ../../public/displayFacilitiesView.php?facility_id=".$facility_id); //send browser to the page for newly created facility
    exit();

} else { //redirect to employee creation page with error message
    header("Location: ../../public/createFacility.php?error=1"); //TODO: how is this handled?
    exit();
}
