<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 3/3/15
 * Time: 3:42 PM
 */

require_once((dirname(__FILE__).'/../scripts/dateTimeProvider.php'));
require_once((dirname(__FILE__).'/../scripts/models/dao/childDAO.php'));
var_dump(dateTimeProvider::getCurrentDateTime());
var_dump(getdate(-50));

echo 'Current Time: '.date('m/d/Y h:i +T', dateTimeProvider::getCurrentDateTime()[0]);

dateTimeProvider::setTestDateTime('1/2/2013 4:56');
echo '<br>Test Time: '.date('m/d/Y h:i +T', dateTimeProvider::getCurrentDateTime()[0]);;

dateTimeProvider::unsetTestDateTime();
echo '<br>Current Time: '.date('m/d/Y h:i +T', dateTimeProvider::getCurrentDateTime()[0]);

$dao = new childDAO();
$child = $dao->find(1);
var_dump($child);
echo($child->expect_checkin[0]);
echo(intval($child->expect_checkin[0]));
var_dump(dateTimeProvider::readableTimeOfDay(intval($child->expect_checkin[0])));