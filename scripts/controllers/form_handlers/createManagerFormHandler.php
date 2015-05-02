<?php
/**
 * The form handler when a company submits form to create a new manager account
 * Determines if submitted manager is valid and adds to managerDAO and redirects to displayManagers page
 * If manager information is not valid, redirects to createManager page with error
 */
require_once(dirname(__FILE__) . '/../authController.php');
require_once(dirname(__FILE__) . '/../../errorManager.php');
require_once(dirname(__FILE__) . '/../../models/dao/managerDAO.php');
require_once(dirname(__FILE__) . '/../../models/dao/facilityDAO.php');
require_once(dirname(__FILE__) . '/../../models/managerModel.php');
require_once(dirname(__FILE__) . '/../../cookieManager.php');
require_once(dirname(__FILE__) . '/../../errorManager.php');

$authController = new authController();
$authController->verifyRole(['company']);
$authController->redirectPage('../../../public/');

$hashedPassword = managerModel::genHashPassword($_POST['password']);

$cookieManager = new cookieManager();
$cookies = $cookieManager->getCookies();

$facilityDao = new facilityDAO();
$facility = $facilityDao->find($_POST['facility_id']);


$manager=new managerModel($_POST['name'], $hashedPassword, $_POST['facility_id'], $_POST['email'], 0, $_POST['address'], $_POST['phone_number']);
$error_code = 0;
if ($facility == false){
    $error_code = errorEnum::facility_not_found;
}
else if ($facility->company_id != $cookies[cookieManager::$userId]){
    $permission =
    $error_code = errorEnum::permission_error;
}
else{
    $error_code = $manager->isValid();
}

if ($error_code == 0) {
    $managerDAO=new managerDAO();
    $managerDAO->createManager($manager);

    header("Location: ../../../public/displayManagers.php");
    exit();
} else {
    header("Location: ../../../public/createManager.php?error=".$error_code);
    exit();
}
