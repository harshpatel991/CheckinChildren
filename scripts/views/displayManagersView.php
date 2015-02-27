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
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <h2 id="title">Created Managers</h2>
    <div id="managers"><?php echo $emplist; ?></div>
    <h3><a href="../public/createManager.php">Create A New Manager</a><br></h3>
    <h3><a id="home" href="../public/index.php">Back to home</a></h3>
</body>
</html>