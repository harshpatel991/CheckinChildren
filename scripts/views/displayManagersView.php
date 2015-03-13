<?php

require_once(dirname(__FILE__).'/../controllers/authController.php');
require_once(dirname(__FILE__).'/../models/dao/managerDAO.php');
require_once(dirname(__FILE__).'/../models/managerModel.php');
require_once(dirname(__FILE__).'/../cookieManager.php');

$managerDAO=new managerDAO();
$managers=$managerDAO->getCompanyManagers($_COOKIE[cookieManager::$userId]);

$emplist='<table class="table">';
$emplist.="<tr><th>Manager Name</th><th>Facility ID</th></tr>";

foreach ($managers as $manager) {
    $emplist.="<tr><td>$manager->emp_name</td><td>$manager->facility_id</td></tr>";
}

$emplist=$emplist."</table>";
?>

<h1 id="title">Created Managers</h1>
<div id="managers"><?php echo $emplist; ?></div>

<a class="btn btn-success" href="../public/createManager.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create A New Manager</a>
<hr>
<a id="home" href="../public/index.php" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Home</a>