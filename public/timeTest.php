<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 3/3/15
 * Time: 3:42 PM
 */
require_once((dirname(__FILE__).'/../scripts/dateTimeProvider.php'));

echo 'Current Time: '.date('m/d/Y h:i +T', dateTimeProvider::getCurrentDateTime()[0]);

dateTimeProvider::setTestDateTime('1/2/2013 4:56');
echo '<br>Test Time: '.date('m/d/Y h:i +T', dateTimeProvider::getCurrentDateTime()[0]);;

dateTimeProvider::unsetTestDateTime();
echo '<br>Current Time: '.date('m/d/Y h:i +T', dateTimeProvider::getCurrentDateTime()[0]);