<?php

/**
 * This controller is called to log the user out of the system.
 */

require_once(dirname(__FILE__).'/../cookieManager.php');
$cookieManager = new cookieManager();
$cookieManager->clearAuthCookies();
unset($_SESSION);
header("Location: ../../public/login.php");