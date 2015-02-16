<?php

require_once(dirname(__FILE__).'/../models/dao/facilityDAO.php');

//Read in POST data
//if(!empty($_POST['submitted'])) {

    $facilityModel = new facilityModel($_POST['company_id'], $_POST['address'], $_POST['phone_number']);

    if ($facilityModel->isValid()) {
        $facilityDAO = new FacilityDAO();
        $facility_id = $facilityDAO->insert($facilityModel);

        header("Location: ../../public/facilities.php?facility_id=".$facility_id); //send browser to the page for newly created facility
        exit();

    } else {
        //redirect to employee creation page with error message
        header("Location: ../../public/companyHome.php"); /* Redirect browser */
        exit();
    }

//}