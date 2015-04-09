<?php
/**
 * The form handler when a company submits form to create a new manager account
 * Determines if submitted manager is valid and adds to managerDAO and redirects to displayManagers page
 * If manager information is not valid, redirects to createManager page with error
 */

require_once(dirname(__FILE__) . '/../../models/dao/managerDAO.php');
require_once(dirname(__FILE__) . '/../../models/dao/facilityDAO.php');
require_once(dirname(__FILE__) . '/../../models/managerModel.php');
require_once(dirname(__FILE__) . '/../../cookieManager.php');

$hashedPassword = managerModel::genHashPassword($_POST['password']);

$facilityDao = new facilityDAO();
$facility = $facilityDao->find($_POST['facility_id']);
$valid = !($facility == false || $facility->company_id != $_COOKIE[cookieManager::$userId]);

$manager=new managerModel($_POST['name'], $hashedPassword, $_POST['facility_id'], $_POST['email'], $_COOKIE[cookieManager::$userId]);

if ($manager->isValid() && $valid) {
    $managerDAO=new managerDAO();
    $managerDAO->createManager($manager);

    header("Location: ../../../public/displayManagers.php");
    exit();
} else {
    header("Location: ../../../public/createManager.php?error=1");
    exit();
}
