<?php
require_once(dirname(__FILE__).'/../controllers/authController.php');
require_once(dirname(__FILE__).'/../models/dao/managerDAO.php');
require_once(dirname(__FILE__).'/../models/dao/logDAO.php');
require_once(dirname(__FILE__).'/../cookieManager.php');

//Find the facilityID of the manager
$managerDAO = new managerDAO();
$manager = $managerDAO->find($_COOKIE[cookieManager::$userId]);
$facilityID = $manager->facility_id;

$logDAO = new logDAO();
$logs = $logDAO->findForFacility($facilityID);
?>

<h1 id="title">Facility Log</h1>

<ul class="dropdown-menu" role="sortBy">
    <li><a href="#">Date</a></li>
    <li><a href="#">Primary Actor</a></li>
    <li><a href="#">Secondary Actor</a></li>
    <li><a href="#">Additional Info</a></li>
    <li><a href="#">Date</a></li>
</ul>

<table class="table table-striped">
    <tr><th>Transaction Type</th><th>Primary Actor</th><th>Secondary Actor</th><th>Additional Info</th><th>Date</th></tr>

    <?php foreach ($logs as $log) { ?>
        <tr>
            <td><?php echo $log->transactionType; ?></td>
            <td><?php echo $log->primaryUser; ?></td>
            <td><?php echo $log->secondaryUser; ?></td>
            <td><?php echo $log->additionalInfo; ?></td>
            <td><?php echo $log->date; ?></td>
        </tr>
    <?php } ?>
</table>

<hr>
<a id="home" href="../public/index.php" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Home</a>