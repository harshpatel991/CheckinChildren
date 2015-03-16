<?php

require_once(dirname(__FILE__).'/../cookieManager.php');
require_once(dirname(__FILE__).'/../models/dao/childDAO.php');
require_once(dirname(__FILE__).'/../models/dao/parentDAO.php');
require_once(dirname(__FILE__).'/../models/childModel.php');

$childDAO = new childDAO();
$parentDAO = new parentDAO();

$parent = $parentDAO->find($_COOKIE[cookieManager::$userId]);
$children=$childDAO->findChildrenWithParent($_COOKIE[cookieManager::$userId]);

$childList="";

foreach ($children as $child) {
    $childList = $childList . '<li class="list-group-item"><a href="displayChild.php?child_id='. $child->child_id . '">' . ($child->child_name). "</a></li>";
}
?>

<h1>My Children</h1>
<ul class="list-group">
    <?php echo $childList; ?>
</ul>

<br>

<a class="btn btn-primary" id="home" href="index.php"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back to Home</a>
