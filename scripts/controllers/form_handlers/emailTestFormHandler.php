<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 3/8/15
 * Time: 3:11 PM
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