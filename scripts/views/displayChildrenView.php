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
    $childList = $childList . '<a href="displayChild.php?child_id='. $child->child_id . '">' . ($child->child_name). "</a><br>";
}

echo $childList;

echo '<br><a href="index.php">Back to Home</a>';