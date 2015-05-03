<?php

require_once(dirname(__FILE__).'/../lib/PHPMailer-master/PHPMailerAutoload.php');
require_once(dirname(__FILE__).'/models/carrierEnum.php');
require_once(dirname(__FILE__).'/../config.php');


/**
 * Class messageAdapter
 *
 * Sends email and SMS messages using gmail API calls.
 */
class messageAdapter
{
    //Whether to suppress message sending for testing purposes.
    private $suppress;

    //Routing emails to SMS services, mapped by carriers.
    private static $carrierRouters = array(
        carrier::att => 'txt.att.net',
        carrier::boost => 'myboostmobile.com',
        carrier::sprint => 'messaging.sprintpcs.com',
        carrier::tmobile => 'tmomail.net',
        carrier::us => 'email.uscc.net',
        carrier::verizon => 'vtext.com',
        carrier::virgin => 'vmobl.com'
    );

    /**
     * Constructs a messageAdapter object
     * Message suppress is only set globally by the config file, defaults to true.
     */
    public function __construct(){
        if (isset(Config::$config['suppress_messages'])){
            $this->suppress = Config::$config['suppress_messages'];
        }
        else{
            //Suppress messages by default
            $this->suppress = true;
        }
    }

    /**
     * Sends email message to recipient with given message and subject.
     *
     * @param string $to the email address
     * @param string $subj string the subject
     * @param string $msg The message
     * @return string the result of the operation, should be changed to error handling in the future
     */
    public function sendMail($to, $subj, $msg){
        if (!$this->suppress){
            $mailer = new PHPMailer();
            try {
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

                if (!$mailer->send()) {
                    return 'Mailer Error: ' . $mailer->ErrorInfo;
                }
            }
            catch (Exception $e){
                return 'Mailer Error: '.$e->getMessage();
            }

            return 'Success';
        }

        return 'Skipping sending for now, to avoid spam.';
    }

    /**
     * Sends SMS message to recipient with given message.
     *
     * @param string $toNumber The phone number.
     * @param string $carrier The carrier (should use carrierEnum).
     * @param string $msg The message.
     * @return string The result of the operation, should be changed to error handling in the future.
     */
    public function sendSMS($toNumber, $carrier, $msg){
        return $this->sendMail($toNumber.'@'.self::$carrierRouters[$carrier], '', $msg);
    }

}