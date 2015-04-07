<?php
/**
 * Form handler to test email notification sending
 * Reads POST information and will send email through adapter
 * Message will not be sent if adapter has suppress turned on
 */
require_once(dirname(__FILE__) . '/../../emailer.php');

$to = $_POST['to'];
$subj = $_POST['subj'];
$msg = $_POST['msg'];

var_dump($to);
var_dump($subj);
var_dump($msg);

$mailer = new messageAdapter();
echo $mailer->sendMail($to, $subj, $msg);