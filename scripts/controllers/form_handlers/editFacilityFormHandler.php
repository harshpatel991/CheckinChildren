<?php
/**
 * The form handler when a company submits form to edit a facility
 * Determines if submitted facility is valid and updates record in facilityDAO and redirects to displayFacility page
 * If facility information is not valid, redirects to editFacility page with error
 */

require_once(dirname(__FILE__) . '/../../cookieManager.php');
require_once(dirname(__FILE__) . '/../../models/dao/facilityDAO.php');


$facility = new facilityModel($_POST["company_id"], $_POST["address"],$_POST["phone"], $_POST["facility_id"]);
$error_code = $facility->isValid();
if ($error_code == 0) {
    $facilityDAO = new FacilityDAO();
    $facilityDAO->update($facility);

    header("Location: ../../../public/displayFacilities.php?facility_id=".$_POST["facility_id"]); //send browser to the page for newly created facility
    exit();
} else {
    header("Location: ../../../public/editFacility.php?facility_id=".$_POST["facility_id"]."&error=".$error_code); //redirect to employee creation page with error message
    exit();
}
