<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2/15/15
 * Time: 8:15 PM
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once(dirname(__FILE__) . '/../../models/dao/childDAO.php');
require_once(dirname(__FILE__) . '/../../models/childModel.php');
require_once(dirname(__FILE__) . '/../../cookieManager.php');
require_once(dirname(__FILE__) . '/../managerController.php');

$manCon=new managerController();
$facility_id=$manCon->getFacilityID($_COOKIE[cookieManager::$userId]);

$child=new childModel($_POST['PID'], $_POST['name'],  $_POST['aller'], $facility_id);


if ($child->isValid()) {
    $childDAO=new childDAO();

    $childDAO->insert($child);
    echo "ok";
    header("Location: ../../../public/index.php");
    exit();
}

else{

    header("Location: ../../../public/createChild.php?error=1");

}