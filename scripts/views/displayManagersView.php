<?php

require_once(dirname(__FILE__).'/../controllers/authController.php');
require_once(dirname(__FILE__).'/../models/dao/managerDAO.php');
require_once(dirname(__FILE__).'/../models/managerModel.php');
require_once(dirname(__FILE__).'/../cookieManager.php');

$managerDAO=new managerDAO();
$managers=$managerDAO->getCompanyManagers($_COOKIE[cookieManager::$userId]);

$emplist='';

foreach ($managers as $manager) {
    $emplist.='<a id='. $manager->id .' class="list-group-item" href="displayEmployee.php?employee_id=' . $manager->id . '">' . ($manager->emp_name) . '</a>';
}

?>

<h1 id="title">Managers</h1>
<div id="managers"><?php echo $emplist; ?></div>

<a class="btn btn-success" name="create_manager" href="../public/createManager.php"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create A New Manager</a>
<hr>
<a id="home" href="../public/index.php" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Home</a>