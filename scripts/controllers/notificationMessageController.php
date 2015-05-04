<?php
require_once(dirname(__FILE__) . '/../../scripts/models/childModel.php');
require_once(dirname(__FILE__) . '/../../scripts/models/parentModel.php');
require_once(dirname(__FILE__) . '/../../scripts/models/dao/childDAO.php');
require_once(dirname(__FILE__) . '/../../scripts/models/childStatusEnum.php');
require_once(dirname(__FILE__) . '/../messageAdapter.php');

/**
 * Class notificationMessageController
 *
 * Controller to send emails to parents of children vith various statuses.
 */
class notificationMessageController{

    private $child;
    private $parent;
    private $messageStatus;
    private $emailer;

    //Templated messages to send via email.
    private static $emailMessages = array(
        messageStatus::child_ready =>'Your child $child_name$ is ready to be picked up',
        messageStatus::child_late =>'Your child $child_name$ has not arrived to daycare yet',
        messageStatus::child_checked_in =>'Your child $child_name$ has been checked in',
        messageStatus::child_checked_out =>'Your child $child_name$ has been checked out'
    );

    //Templated subjects to send via email.
    private static $emailSubjects = array(
        messageStatus::child_ready =>'Message from CheckinChildren',
        messageStatus::child_late =>'Urgent Message from CheckinChildren',
        messageStatus::child_checked_in =>'Message from CheckinChildren',
        messageStatus::child_checked_out =>'Message from CheckinChildren',
    );

    //Templated messages to send via SMS.
    private static $smsMessages = array(
        messageStatus::child_ready =>'Your child $child_name$ is ready to be picked up',
        messageStatus::child_late =>'Your child $child_name$ has not arrived to daycare yet',
        messageStatus::child_checked_in =>'Your child $child_name$ has been checked in',
        messageStatus::child_checked_out =>'Your child $child_name$ has been checked out'
    );

    /**
     * Constructor should only be called from notificationMessageFactory, not called directly from other classes.
     *
     * @param childModel $child  The child to send notifications from.
     * @param int $messageStatus The status of the child to send via notification (should use messageStatus enum).
     * @param messageAdapter $emailer The messageAdapter used to send messages, only used for dependency injection.
     */
    public function __construct($child, $messageStatus, $emailer){
        $this->emailer = $emailer;
        $this->child = $child;
        $parentDao = new parentDAO();
        $this->parent = $parentDao->find($child->parent_id);
        $this->messageStatus = $messageStatus;
    }

    /**
     * Sends the proper notification to parent, if they exist, based on contact preferences.
     *
     * @return string result The message of operation, Should be converted to error message in future.
     */
    public function sendStatusNotification(){
        if (!isset($this->parent) || $this->parent === null){
            return 'Parent not found';
        }

        if (intval($this->child->last_message_status) === $this->messageStatus){
            return 'Message already sent';
        }

        if(strpos($this->parent->contact_pref, 'email') !== false){
            $this->sendParentEmail();
        }

        if(strpos($this->parent->contact_pref, 'text') !== false){
            $this->sendParentSms();
        }

        $this->child->last_message_status = $this->messageStatus;
        $childDao = new childDAO();
        $childDao->update($this->child);
        return 'Success';
    }

    /**
     * Constructs and sends an email to the parent.
     */
    private function sendParentEmail(){
        $to = $this->parent->email;
        $subj = $this->buildString(self::$emailSubjects[$this->messageStatus]);
        $msg = $this->buildString(self::$emailMessages[$this->messageStatus]);
        $this->emailer->sendMail($to, $subj, $msg);
    }

    /**
     * Constructs and sends an SMS to the parent.
     */
    private function sendParentSms(){
        $number = $this->parent->phone_number;
        $carrier = $this->parent->carrier;
        $msg = $this->buildString(self::$smsMessages[$this->messageStatus]);
        $this->emailer->sendSMS($number, $carrier, $msg);
    }

    /**
     * Constructs a string from the templated message by inserting information
     *
     * @param string $str The template string.
     * @return mixed string the constructed string.
     */
    private function buildString($str){
        return str_replace('$child_name$', $this->child->child_name, $str);
    }
}