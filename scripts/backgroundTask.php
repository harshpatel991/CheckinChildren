<?php
require_once(dirname(__FILE__).'/models/facilityModel.php');
require_once(dirname(__FILE__).'/models/childModel.php');
require_once(dirname(__FILE__).'/models/dao/facilityDAO.php');
require_once(dirname(__FILE__).'/models/dao/childDAO.php');
require_once(dirname(__FILE__).'/models/childStatusEnum.php');
require_once(dirname(__FILE__).'/emailer.php');
require_once(dirname(__FILE__).'/models/carrierEnum.php');
/*
 * This will mimic a chron job locally by providing a single callable iteration of schedule checks.
 */

class backgroundTask
{
    private static $emailMessages = array(
        childStatus::here_due =>'Your child $name$ is ready to be picked up',
        childStatus::not_here_late =>'Your child $name$ has not arrived to daycare yet'
    );

    private static $emailSubjects = array(
        childStatus::here_due =>'Message from CheckinChildren',
        childStatus::not_here_late =>'Urgent Message from CheckinChildren'
    );

    private static $smsMessages = array(
        childStatus::here_due =>'Your child $name$ is ready to be picked up',
        childStatus::not_here_late =>'Your child $name$ has not arrived to daycare yet'
    );

    public static function sendEmailsAndTexts(){
        $facilityDao = new FacilityDAO();
        $facilityIds = $facilityDao->findAllFacilityIds();
        $childDao = new childDAO();
        foreach($facilityIds as $id){
            self::sendEmailsToParents($childDao->findChildrenInFacility($id));
        }
    }

    private static function sendEmailsToParents($children){
        foreach($children as $child){
            $status = $child->getStatus();
            if (array_key_exists($status, self::$emailMessages)) {
                self::sendEmail($child, $status);
                self::sendSMS($child, $status);
            }
        }
    }

    private static function sendEmail($child, $status){
        $parentDao = new parentDAO();
        $parent = $parentDao->find($child->parent_id);
        $message = str_replace('$name$', $child->child_name, self::$emailMessages[$status]);
        $subject = str_replace('$name$', $child->child_name, self::$emailSubjects[$status]);


        echo 'Email To: ' .$parent->email.', Subject: '.$subject;
        echo "\r\n";
        echo 'Message: '.$message;
        echo "\r\n\r\n";

        // Don't actally send until release or until test data is safe.
        // $emailer = new emailer();
        // $emailer->sendMail($parent->email, $subject, $message);
    }

    private static function sendSMS($child, $status){
        $parentDao = new parentDAO();
        $parent = $parentDao->find($child->parent_id);
        $message = str_replace('$name$', $child->child_name, self::$emailMessages[$status]);


        echo 'SMS To: ' .$parent->phone_number.', Carrier: '.$parent->carrier;
        echo "\r\n";
        echo 'Message: '.$message;
        echo "\r\n\r\n";

        // Don't actally send until release or until test data is safe.
        // $emailer = new emailer();
        // $emailer->sendSMS($parent->phone_number, $parent->carrier, $message);
    }
}

backgroundTask::sendEmailsAndTexts();
$emailer = new emailer();
echo $emailer->sendSMS(2023291703, carrier::verizon, 'hello');