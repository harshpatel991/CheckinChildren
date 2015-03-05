<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/4/15
 * Time: 9:05 PM
 */

require_once(dirname(__FILE__) . '/../../models/dao/childDAO');
require_once(dirname(__FILE__) . '/../../models/childModel.php');
require_once(dirname(__FILE__) . '/../../dateTimeProvider.php');

$checkoutArray=$_POST["checkouts"];
$checkinArray=$_POST["checkins"];

$dtprovider= new dateTimeProvider();
$curTime= $dtprovider->getCurrentDateTime();

$timeString= $curTime["year"]. "-" . $curTime["month"] . "-" . $curTime["mday"] . " " . $curTime["hours"] .
    ":" . $curTime["minutes"] . $curTime["seconds"];

$cDAO=new childDAO();

foreach ($checkoutArray as $id){
    $child=$cDAO->find($id);
    $child->last_checkout=$timeString;
    $cDAO->update($child);
}

foreach ($checkinArray as $id){
    $child=$cDAO->find($id);
    $child->last_checkin=$timeString;
    $cDAO->update($child);
}

header("Location: ../../../public/checkinChildren.php");