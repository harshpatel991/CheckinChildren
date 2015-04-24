<?php
require_once(dirname(__FILE__).'/backgroundTask.php');

$task = new backgroundTask();
$task->sendEmailsAndTexts();