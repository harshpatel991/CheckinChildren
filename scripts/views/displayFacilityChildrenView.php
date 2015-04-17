<?php
require_once(dirname(__FILE__).'/../controllers/managerController.php');
require_once(dirname(__FILE__).'/../models/dao/childDAO.php');
require_once(dirname(__FILE__).'/../models/childModel.php');

$htmlFileLocation = dirname(__FILE__).'/../../html/managerIndex.html';

$managercontroller= new managerController();

$childdao=new childDAO();
$children=$childdao->findChildrenInFacility($_GET['facility_id']);

$childlist="";

foreach ($children as $child) {
    $childlist = $childlist . '<a id='. $child->child_id .' class="list-group-item" href="displayChild.php?child_id=' . $child->child_id . '">' . ($child->child_name) . '</a>';
}
?>

<h1>Children in Facility </h1>
<ul id="children" class="list-group">
    <?php echo $childlist;?>
</ul>

<hr>
<a class="btn btn-primary" id="home" href="index.php" name="back_home"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back to Home</a>
