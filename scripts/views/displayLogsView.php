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
$filterBy = '%'; //default filter;

//retrieve order by GET parameter, if specified
if(isset($_GET['orderBy']) && !empty($_GET['orderBy'])) {
    $orderBy = $_GET['orderBy'];
}

//retrieve order by GET parameter, if specified
if(isset($_GET['filterBy']) && !empty($_GET['filterBy'])) {
    $filterBy = $_GET['filterBy'];
}

$logDAO = new logDAO();
$logs = $logDAO->findForFacility($facilityID, $orderBy, $filterBy);
?>

<h1 id="title">Facility Log</h1>

<form method="GET" action="displayLogs.php" class="form-inline pull-right">

    <label for="filterBy">Filter By</label>
    <select class="form-control" name="filterBy">
        <option selected="selected" value="">None</option>
        <option>Child Checked In</option>
        <option>Child Checked Out</option>
        <option>Child Created</option>
        <option>Employee Created</option>
        <option>Parent Created</option>
        <option>Employee Promoted</option>
        <option>Employee Edited</option>
    </select>

    <label for="orderBy"> Order By</label>
    <select class="form-control" name="orderBy">
        <option selected="selected" value="">None</option>
        <option value="time_created">Date</option>
        <option value="transaction_type">Transaction Type</option>
        <option value="primary_name">Primary Actor Name</option>
        <option value="secondary_name">Secondary Actor Name</option>
        <option value="additional_info">Additional Info</option>
    </select>

    <input class="btn btn-default" type="submit" name="submit"/>

</form>





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