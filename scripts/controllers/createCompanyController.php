<?php

require_once(dirname(__FILE__).'/../models/dao/companyDAO.php');

//Read in POST data from form
header("Location: ../../public/createCompany.php");
$company = new companyModel($_POST['company_name'],$_POST['address'], $_POST['phone_number'], $_POST['email'], $_POST['password'], $_POST['role']);

if ($company->isValid()) {


    $companyDAO = new CompanyDAO();
    $facility_id = $companyDAO->createCompany($company);
    header("Location: ../../public/login.php"); //send browser to the login page
    exit();

} else { //redirect to employee creation page with error message
    header("Location: ../../public/createCompany.php?error=1"); //TODO: how is this handled?
    exit();
}
