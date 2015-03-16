<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 3/8/15
 * Time: 4:42 PM
 */
require_once(dirname(__FILE__).'/../lib/PHPMailer-master/PHPMailerAutoload.php');
require_once(dirname(__FILE__).'/models/carrierEnum.php');
require_once(dirname(__FILE__).'/../config.php');



class emailer
{
    private $mailer;

    private static $carriers = array(
        carrier::att => 'txt.att.net',
        carrier::boost => 'myboostmobile.com',
        carrier::sprint => 'messaging.sprintpcs.com',
        carrier::tmobile => 'tmomail.net',
        carrier::us => 'email.uscc.net',
        carrier::verizon => 'vtext.com',
        carrier::virgin => 'vmobl.com'
    );

    public function __construct(){
        $this->mailer = new PHPMailer();
        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.gmail.com';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = 'checkinchildren@gmail.com';
        $this->mailer->Password = 'CS428CheckinChildren';
        $this->mailer->SMTPSecure = 'ssl';
        $this->mailer->Port = 465;
        $this->mailer->From = 'checkinchildren@gmail.com';
        $this->mailer->FromName = 'CheckinChildren';
    }

    public function sendMail($to, $subj, $msg){
        $this->mailer->addAddress($to);
        $this->mailer->isHTML(true);
        $this->mailer->Subject = $subj;
        $this->mailer->Body = $msg;

        /*if (!$this->mailer->send()){
            return 'Mailer Error: '.$this->mailer->ErrorInfo;
        }*/
        return 'Skipping sending for now, to avoid spam.';
    }

    public function sendSMS($toNumber, $carrier, $msg){
        return $this->sendMail($toNumber.'@'.self::$carriers[$carrier], '', $msg);
    }
}