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



class messageAdapter
{
    private $mailer;
    private $suppress;

    private static $carrierRouters = array(
        carrier::att => 'txt.att.net',
        carrier::boost => 'myboostmobile.com',
        carrier::sprint => 'messaging.sprintpcs.com',
        carrier::tmobile => 'tmomail.net',
        carrier::us => 'email.uscc.net',
        carrier::verizon => 'vtext.com',
        carrier::virgin => 'vmobl.com'
    );

    public function __construct(){
        if (isset(Config::$config['suppress_messages'])){
            $this->suppress = Config::$config['suppress_messages'];
        }
        else{
            //Suppress messages by default
            $this->suppress = true;
        }
    }

    public function sendMail($to, $subj, $msg){
        if (!$this->suppress){
            $mailer = new PHPMailer();
            $mailer->isSMTP();
            $mailer->Host = 'smtp.gmail.com';
            $mailer->SMTPAuth = true;
            $mailer->Username = 'checkinchildren@gmail.com';
            $mailer->Password = 'CS428CheckinChildren';
            $mailer->SMTPSecure = 'ssl';
            $mailer->Port = 465;
            $mailer->From = 'checkinchildren@gmail.com';
            $mailer->FromName = 'CheckinChildren';
            $mailer->addAddress($to);
            $mailer->isHTML(true);
            $mailer->Subject = $subj;
            $mailer->Body = $msg;

            if (!$mailer->send()){
                return 'Mailer Error: '.$mailer->ErrorInfo;
            }

            return 'Success';
        }

        return 'Skipping sending for now, to avoid spam.';
    }

    public function sendSMS($toNumber, $carrier, $msg){
        return $this->sendMail($toNumber.'@'.self::$carrierRouters[$carrier], '', $msg);
    }

}