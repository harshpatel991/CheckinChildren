<?php
require_once(dirname(__FILE__).'/../controllers/authController.php');
require_once(dirname(__FILE__).'/../models/dao/managerDAO.php');
require_once(dirname(__FILE__).'/../models/dao/logDAO.php');
require_once(dirname(__FILE__).'/../cookieManager.php');

//Find the facilityID of the manager
$managerDAO = new managerDAO();

$manager = $managerDAO->find($_COOKIE[cookieManager::$userId]);
$facilityID = $manager['facility_id'];

$orderBy = 'time_created'; //default order by

//retrieve order by GET parameter, if specified
if(isset($_GET['orderBy']) && !empty($_GET['orderBy'])) {
    $orderBy = $_GET['orderBy'];
}

$logDAO = new logDAO();
$logs = $logDAO->findForFacility($facilityID, $orderBy);

//echo $orderBy;
?>

<h1 id="title">Facility Log</h1>

<!-- Single button -->
<div class="btn-group pull-right">
    <button type="button" class="btn btn-info dropdown-toggle pull-right " data-toggle="dropdown" aria-expanded="false">Sort By <span class="caret"></span></button>
    <ul class="dropdown-menu " role="menu">
        <li><a href="displayLogs.php?orderBy=time_created">Date</a></li>
        <li><a href="displayLogs.php?orderBy=transaction_type">Transaction Type</a></li>
        <li><a href="displayLogs.php?orderBy=primary_name">Primary Actor Name</a></li>
        <li><a href="displayLogs.php?orderBy=secondary_name">Secondary Actor Name</a></li>
        <li><a href="displayLogs.php?orderBy=additional_info">Additional Info</a></li>
    </ul>
</div>
<br><br>

<table class="table table-striped">
    <tr><th>Date</th><th>Transaction Type</th><th>Primary Actor</th><th>Secondary Actor</th><th>Additional Info</th></tr>

    <?php foreach ($logs as $log) { ?>
        <tr>
            <td><?php echo $log['time_created']; ?></td>
            <td><?php echo $log['transaction_type']; ?></td>
            <td><?php echo $log['primary_name']; ?></td>
            <td><?php echo $log['secondary_name']; ?></td>
            <td><?php echo $log['additional_info']; ?></td>
        </tr>
    <?php } ?>
</table>


<a id="home" href="../public/index.php" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Home</a>