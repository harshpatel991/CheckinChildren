<?php
require_once(dirname(__FILE__) . '/../../scripts/models/childModel.php');
require_once(dirname(__FILE__) . '/../../scripts/models/childStatusEnum.php');
require_once(dirname(__FILE__) . '/../messageAdapter.php');


class notificationMessageController{

    private $child;
    private $parent;
    private $messageStatus;
    private $emailer;

    private static $emailMessages = array(
        messageStatus::child_ready =>'Your child $child_name$ is ready to be picked up',
        messageStatus::child_late =>'Your child $child_name$ has not arrived to daycare yet'
    );

    private static $emailSubjects = array(
        messageStatus::child_ready =>'Message from CheckinChildren',
        messageStatus::child_late =>'Urgent Message from CheckinChildren'
    );

    private static $smsMessages = array(
        messageStatus::child_ready =>'Your child $child_name$ is ready to be picked up',
        messageStatus::child_late =>'Your child $child_name$ has not arrived to daycare yet'
    );

    public function __construct($child, $messageStatus, $emailer = null){
        if ($emailer === null){
            $emailer = new messageAdapter();
        }
        $this->emailer = $emailer;
        $this->child = $child;
        $parentDao = new parentDAO();
        $this->parent = $parentDao->find($child->parent_id);
        $this->messageStatus = $messageStatus;
    }

    public function sendStatusNotification(){
        if (!isset($this->parent) || $this->parent === null){
            echo 'here';
            return 'Parent not found';
        }

        if ($this->parent->last_message_status === $this->messageStatus){
            return 'Message already sent';
        }

        if(strpos($this->parent->contact_pref, 'email') !== false){
            $this->sendParentEmail();
        }

        if(strpos($this->parent->contact_pref, 'text') !== false){
            $this->sendParentSms();
        }

        return 'Success';
    }

    private function sendParentEmail(){
        $to = $this->parent->email;
        $subj = $this->buildString(self::$emailSubjects[$this->messageStatus]);
        $msg = $this->buildString(self::$emailMessages[$this->messageStatus]);
        $this->emailer->sendMail($to, $subj, $msg);
    }

    private function sendParentSms(){
        $number = $this->parent->phone_number;
        $carrier = $this->parent->carrier;
        $msg = $this->buildString(self::$smsMessages[$this->messageStatus]);
        $this->emailer->sendSMS($number, $carrier, $msg);
    }

    private function buildString($str){
        return str_replace('$child_name$', $this->child->child_name, $str);
    }
}