<?php
/**
 * The form handler when a company submits form to create a company account
 * Determines if submitted company is valid and adds to companyDAO
 * If company account is not valid, redirects to createCompany page with error
 */
require_once(dirname(__FILE__) . '/../../models/dao/companyDAO.php');

//Read in POST data from form
$hashedPassword = companyModel::genHashPassword($_POST['create_password']);
$company = new companyModel($_POST['company_name'],$_POST['address'], $_POST['phone_number'], $_POST['create_email'], $hashedPassword, $_POST['role']);

if ($company->isValid()) {
    $companyDAO = new CompanyDAO();
    $facility_id = $companyDAO->createCompany($company);
    header("Location: ../../../public/login.php"); //send browser to the login page
    exit();
} else {
    header("Location: ../../../public/createCompany.php?error=1"); //redirect to employee creation page with error message
    exit();
}
