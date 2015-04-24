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
require_once(dirname(__FILE__) . '/../../models/dao/logDAO.php');
require_once(dirname(__FILE__) . '/../../models/childModel.php');
require_once(dirname(__FILE__) . '/../../dateTimeProvider.php');
require_once(dirname(__FILE__) . '/../notificationMessageFactory.php');
require_once(dirname(__FILE__) . '/../notificationMessageController.php');
require_once(dirname(__FILE__) . '/../../cookieManager.php');

$authController = new authController();
$authController->verifyRole(['employee','manager']);
$authController->redirectPage('../../../public/');

$checkinIdArray=$_POST["checkinChildId"];
$checkinActorArray=$_POST["checkinActor"];
$checkoutIdArray=$_POST["checkoutChildId"];
$checkoutActorArray=$_POST["checkoutActor"];


if (count($checkinIdArray) != count($checkinActorArray) || count($checkoutIdArray) != count($checkoutActorArray)){
    header("Location: ../../../public/checkinChildren.php?error=".errorEnum::data_error);
    exit();
}

foreach ($checkinActorArray as $actorName){
    if (empty($actorName)){
        header("Location: ../../../public/checkinChildren.php?error=".errorEnum::missing_child_actor);
        exit();
    }
}
foreach ($checkoutActorArray as $actorName){
    if (empty($actorName)){
        header("Location: ../../../public/checkinChildren.php?error=".errorEnum::missing_child_actor);
        exit();
    }
}
foreach ($checkinIdArray as $id){
    if (empty($id)){
        header("Location: ../../../public/checkinChildren.php?error=".errorEnum::data_error);
        exit();
    }
}
foreach ($checkoutIdArray as $id){
    if (empty($id)){
        header("Location: ../../../public/checkinChildren.php?error=".errorEnum::data_error);
        exit();
    }
}

$curTime= dateTimeProvider::getCurrentDateTime();
dateTimeProvider::testTimeTick();

$timeFill= "%04d-%02d-%02d %02d:%02d:%02d";

$timeString= sprintf($timeFill,$curTime["year"], $curTime["mon"], $curTime["mday"], $curTime["hours"],$curTime["minutes"]
    , $curTime["seconds"]);

$cDAO=new childDAO();
$lDAO=new logDAO();
$cookieManager = new cookieManager();
$empId=$cookieManager->getCookies()[cookieManager::$userId];

for ($i=0; $i<count($checkoutIdArray); $i++){
    $id = $checkoutIdArray[$i];
    $cDAO->updateField($id, 'last_checkout', $timeString);
    $child = $cDAO->find($id);
    $notificationController = (new notificationMessageFactory())->create($child, messageStatus::child_checked_out);
    $notificationController->sendStatusNotification();
    $lDAO->insert($empId, $child->child_id, $child->child_name, logDAO::$childCheckOut, $checkoutActorArray[$i]);
}

for ($i=0; $i<count($checkinIdArray); $i++){
    $id = $checkinIdArray[$i];
    $cDAO->updateField($id, 'last_checkin', $timeString);
    $child = $cDAO->find($id);
    $notificationController = (new notificationMessageFactory())->create($child, messageStatus::child_checked_in);
    $notificationController->sendStatusNotification();
    $lDAO->insert($empId, $child->child_id, $child->child_name, logDAO::$childCheckIn, $checkinActorArray[$i]);
}

header("Location: ../../../public/checkinChildren.php");
exit();