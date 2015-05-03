<?php
/**
 * This is class displays the home page once a user logs in. For parents, it displays the current status of their child.
 */

require_once(dirname(__FILE__).'/../cookieManager.php');?>
<head>
    <title>CheckinChildren</title>
</head>
<h1>Welcome to Checkin Children</h1>

<?php
if ($_COOKIE[cookieManager::$userRole] == "parent") {
    require_once(dirname(__FILE__) . '/../cookieManager.php');
    require_once(dirname(__FILE__) . '/../models/dao/childDAO.php');
    require_once(dirname(__FILE__) . '/../models/dao/parentDAO.php');
    require_once(dirname(__FILE__) . '/../models/childModel.php');
    require_once(dirname(__FILE__).'/../dateTimeProvider.php');

    $childDAO = new childDAO();
    $parentDAO = new parentDAO();

    $children = $childDAO->findChildrenWithParent($_COOKIE[cookieManager::$userId]); //find all of the parent's children

    $childList = "";

    foreach ($children as $child) { //This loop appends a different colored gif to each child depending on their status
        if ($child->getStatus() == childStatus::here_due || $child->getStatus() == childStatus::not_here_late) {
            $childList = $childList . '<li class="list-group-item"><img src="../images/childStatus/flash.gif" width="8px" heigh="8px"> <a href="displayChild.php?child_id=' . $child->child_id . '">' . ($child->child_name) . "</a></li>";
        }
    }
    ?>
    <ul class="list-group">
        <?php echo $childList; ?>
    </ul>
<?php
}
?>
