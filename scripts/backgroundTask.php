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

/**
 * Class backgroundTask
 *
 * This will mimic a chron job locally by providing a single callable iteration of schedule checks.
 */
class backgroundTask
{
    private $notificationMessageFactory;

    /**
     * Constructs a backgroundTask
     * @param notificationMessageFactory $notificationMessageFactory used for dependency injection
     */
    public function __construct($notificationMessageFactory = null){
        if(!isset($notificationMessageFactory) || $notificationMessageFactory === null){
            $notificationMessageFactory = new notificationMessageFactory();
        }

        $this->notificationMessageFactory = $notificationMessageFactory;
    }

    /**
     * Sends late and ready notification messages to all parents in db.
     */
    public function sendEmailsAndTexts(){
        $facilityDao = new FacilityDAO();
        $facilityIds = $facilityDao->findAllFacilityIds();
        $childDao = new childDAO();
        foreach($facilityIds as $id){
            $this->sendMessagesToParents($childDao->findChildrenInFacility($id));
        }
    }

    /**
     * Sends notification messages to parents of all children.
     *
     * @param $children childModel[] the children.
     */
    private function sendMessagesToParents($children){
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