<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once(dirname(__FILE__).'/../models/dao/managerDAO.php');
require_once(dirname(__FILE__).'/../models/dao/facilityDAO.php');
require_once(dirname(__FILE__).'/../models/managerModel.php');
require_once(dirname(__FILE__).'/../cookieManager.php');


$hashedPassword = managerModel::genHashPassword($_POST['password']);

$facilityDao = new facilityDAO();
$facility = $facilityDao->find($_POST['facility_id']);
$valid = !($facility == false || $facility->company_id != $_COOKIE[cookieManager::$userId]);

$manager=new managerModel($_POST['name'], $hashedPassword, $_POST['facility_id'], $_COOKIE[cookieManager::$userId], $_POST['email'], $_POST['role']);

if ($manager->isValid() && $valid) {
    $managerDAO=new managerDAO();
    $managerDAO->createManager($manager);

    header("Location: ../../public/displayManagers.php");
    exit();
} else {
    header("Location: ../../public/createManager.php?error=1");
    exit();
}
