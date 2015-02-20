<?php

require_once(dirname(__FILE__).'/../controllers/authController.php');
require_once(dirname(__FILE__).'/../models/dao/managerDAO.php');
require_once(dirname(__FILE__).'/../models/managerModel.php');
require_once(dirname(__FILE__).'/../cookieManager.php');

$htmlFileLocation = dirname(__FILE__).'/../../html/displayManagers.html';

$managerDAO=new managerDAO();
$managers=$managerDAO->getCompanyManagers($_COOKIE[cookieManager::$userId]);

$facilities = $managerDAO->getFacilityManagers(1);

$emplist="<table border='1'>";
$emplist.="<tr><td>Manager Name</td><td>Facility ID</td></tr>";

foreach ($managers as $manager) {
    $emplist.="<tr><td>$manager->emp_name</td><td>$manager->facility_id</td></tr>";
}

$emplist=$emplist."</table>";

$template=file_get_contents ($htmlFileLocation);
$template=str_replace("MANAGER_LIST", $emplist, $template);
echo $template;