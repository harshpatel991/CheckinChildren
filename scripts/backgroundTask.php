<?php
require_once(dirname(__FILE__).'/models/facilityModel.php');
require_once(dirname(__FILE__).'/models/childModel.php');
require_once(dirname(__FILE__).'/models/dao/facilityDAO.php');
require_once(dirname(__FILE__).'/models/dao/childDAO.php');
require_once(dirname(__FILE__).'/models/childStatusEnum.php');
require_once(dirname(__FILE__).'/messageAdapter.php');
require_once(dirname(__FILE__).'/models/carrierEnum.php');
require_once(dirname(__FILE__).'/controllers/notificationMessageFactory.php');
require_once(dirname(__FILE__).'/controllers/notificationMessageController.php');
/*
 * This will mimic a chron job locally by providing a single callable iteration of schedule checks.
 */

class backgroundTask
{
    private $notificationMessageFactory;

    public function __construct($notificationMessageFactory = null){
        if(!isset($notificationMessageFactory) || $notificationMessageFactory === null){
            $notificationMessageFactory = new notificationMessageFactory();
        }

        $this->notificationMessageFactory = $notificationMessageFactory;
    }

    public function sendEmailsAndTexts(){
        $facilityDao = new FacilityDAO();
        $facilityIds = $facilityDao->findAllFacilityIds();
        $childDao = new childDAO();
        foreach($facilityIds as $id){
            $this->sendFailityEmails($childDao->findChildrenInFacility($id));
        }
    }

    private function sendFailityEmails($children){
        foreach($children as $child){
            $status = $child->getStatus();

            if ($status === childStatus::not_here_late){
                $messageController = $this->notificationMessageFactory->create($child, messageStatus::child_late);
                $messageController->sendStatusNotification();
            }
            else if ($status === childStatus::here_due){
                $messageController = $this->notificationMessageFactory->create($child, messageStatus::child_ready);
                $messageController->sendStatusNotification();
            }
        }
    }
}