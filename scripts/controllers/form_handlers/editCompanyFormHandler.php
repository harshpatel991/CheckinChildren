<?php
/**
 * The form handler when a parent submits form to edit their account
 * Determines if submitted parent is valid and updates record in parentDAO and redirects to displayParentInfo page
 * If parent information is not valid, redirects to editParent page with error
 */

require_once(dirname(__FILE__) . '/../authController.php');
require_once(dirname(__FILE__) . '/../../cookieManager.php');
require_once(dirname(__FILE__) . '/../../models/dao/companyDAO.php');
require_once(dirname(__FILE__).'/../../models/companyModel.php');

$authController = new authController();
$authController->verifyRole(['company']);
$authController->redirectPage('../../../public/');

//Read in POST data from form
$company_id = $_COOKIE[cookieManager::$userId];


$company = new companyModel($_POST["company_name"], $_POST["address"], $_POST["phone_number"], $_POST["email"],"", "company", $company_id);
$error_code = $company->isUpdateValid();
if ($error_code == 0) {
    $companyDAO = new CompanyDAO();
    $companyDAO->update($company);

    header("Location: ../../../public/displayCompanyInfo.php"); //send browser to the page for newly created facility
    exit();
} else {
    header("Location: ../../../public/editCompany.php?error=".$error_code); //redirect to employee creation page with error message
    exit();
}
