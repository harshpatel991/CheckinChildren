<?php
/**
 * Runs the background task to mimic the chron job of a deployed server.
 * Sends necessary notification messages to parents of children regarding child statuses.
 */

require_once(dirname(__FILE__).'/backgroundTask.php');

$task = new backgroundTask();
$task->sendEmailsAndTexts();