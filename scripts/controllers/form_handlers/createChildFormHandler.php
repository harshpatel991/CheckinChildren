<?php
/**
 * The form handler when a employee/manager submits form to create a child
 * Determines if submitted child is valid and adds to childDAO
 * If child is not valid, redirects to createChild page with error
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once(dirname(__FILE__) . '/../../models/dao/childDAO.php');
require_once(dirname(__FILE__) . '/../../models/dao/logDAO.php');
require_once(dirname(__FILE__) . '/../../models/childModel.php');
require_once(dirname(__FILE__) . '/../../cookieManager.php');
require_once(dirname(__FILE__) . '/../managerController.php');

$manCon=new managerController();
$facility_id=$manCon->getFacilityID($_COOKIE[cookieManager::$userId]);

$child=new childModel($_POST['PID'], $_POST['name'],  $_POST['aller'], $_POST['trusted_parties'], $facility_id);
for ($i=0; $i<7; $i++){
    $child->expect_checkin[$i] = minutesFromMidnight($_POST['ci-'.$i]);
    $child->expect_checkout[$i] = minutesFromMidnight($_POST['co-'.$i]);
}

$lDAO= new logDAO();
if ($child->isValid()) {
    $childDAO = new childDAO();
    $childId = $childDAO->insert($child);
    $child->child_id = $childId;
    $childDAO->update($child);
    $lDAO->insert($_COOKIE[cookieManager::$userId], $child->child_id, $child->child_name, logDAO::$childCreated);
    header("Location: ../../../public/index.php");

    exit();
} else {
    $lDAO->insert($_COOKIE[cookieManager::$userId], $child->child_id, $child->child_name, logDAO::$childCreated, "Failure");
    header("Location: ../../../public/createChild.php?error=1");
}

/*
 * Determines the minutes from midnight of a given time
 * $time string of format '2:30 am'
 *
 * returns minutes-from-midnight
 */
function minutesFromMidnight($time){
    if(!isset($time) || $time==='' || $time==null) {
        return -1;
    }
    $hmap = preg_split("/[\s:]+/", $time);
    $hmap[0] %= 12;
    if ($hmap[2] === 'pm'){
        $hmap[0] += 12;
    }
    return $hmap[1] + $hmap[0] * 60;
}