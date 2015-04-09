<?php
/**
 * The form handler when a employee/manager submits form to check in/ check out children from the facility
 * Sets last_checkout/last_checkin values of children and sends appropriate notifications
 * Once completed, redirects to checkinChildren page
 */

require_once(dirname(__FILE__) . '/../authController.php');
require_once(dirname(__FILE__) . '/../../errorManager.php');
require_once(dirname(__FILE__) . '/../../cookieManager.php');
require_once(dirname(__FILE__) . '/../../models/dao/childDAO.php');
require_once(dirname(__FILE__) . '/../../models/childModel.php');
require_once(dirname(__FILE__) . '/../../dateTimeProvider.php');
require_once(dirname(__FILE__) . '/../notificationMessageFactory.php');
require_once(dirname(__FILE__) . '/../notificationMessageController.php');

if($_COOKIE[cookieManager::$userRole] != 'employee' && $_COOKIE[cookieManager::$userRole] != 'manager'){
    header("Location: ../../../public/checkinChildren.php?error=".errorEnum::permission_error);
    exit();
}

$checkinArray=$_POST["checkinIds"];
$checkoutArray=$_POST["checkoutIds"];

$curTime= dateTimeProvider::getCurrentDateTime();
dateTimeProvider::testTimeTick();

$timeFill= "%04d-%02d-%02d %02d:%02d:%02d";

$timeString= sprintf($timeFill,$curTime["year"], $curTime["mon"], $curTime["mday"], $curTime["hours"],$curTime["minutes"]
    , $curTime["seconds"]);

$cDAO=new childDAO();

foreach ($checkoutArray as $id){
    $cDAO->updateField($id, 'last_checkout', $timeString);
    $child = $cDAO->find($id);
    $notificationController = (new notificationMessageFactory())->create($child, messageStatus::child_checked_out);
    $notificationController->sendStatusNotification();
}

foreach ($checkinArray as $id){
    $cDAO->updateField($id, 'last_checkin', $timeString);
    $child = $cDAO->find($id);
    $notificationController = (new notificationMessageFactory())->create($child, messageStatus::child_checked_in);
    $notificationController->sendStatusNotification();
}

header("Location: ../../../public/checkinChildren.php");
exit();