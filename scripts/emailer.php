<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 3/8/15
 * Time: 4:42 PM
 */
require_once(dirname(__FILE__).'/../lib/PHPMailer-master/PHPMailerAutoload.php');


class emailer
{
    private $mailer;

    private static $carriers = array(
        'att' => 'txt.att.net',
        'boost' => 'myboostmobile.com',
        'sprint' => 'messaging.sprintpcs.com',
        'tmobile' => 'tmomail.net',
        'us' => 'email.uscc.net',
        'verizon' => 'vtext.com',
        'virgin' => 'vmobl.com'
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
    }

    public function sendMail($to, $subj, $msg){
        $this->mailer->From = 'checkinchildren@gmail.com';
        $this->mailer->FromName = 'CheckinChildren';
        $this->mailer->addAddress($to);
        $this->mailer->isHTML(true);
        $this->mailer->Subject = $subj;
        $this->mailer->Body = $msg;

        if (!$this->mailer->send()){
            return 'Mailer Error: '.$this->mailer->ErrorInfo;
        }
        return 'Success!';
    }

    public function sendSMS($toNumber, $carrier, $msg){
        return $this->sendMail($toNumber.'@'.self::$carriers[$carrier], '', $msg);
    }
}