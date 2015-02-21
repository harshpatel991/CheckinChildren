<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 2/16/15
 * Time: 5:10 AM
 */
require_once(dirname(__FILE__).'/../cookieManager.php');

cookieManager::clearAuthCookies();
header("Location: ../../public/login.php");