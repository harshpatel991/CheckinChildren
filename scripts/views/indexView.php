<?php require_once(dirname(__FILE__).'/../cookieManager.php');?>

<h1>Welcome to Checkin Children</h1>
<h3>Currently signed in as a <?php echo $_COOKIE[cookieManager::$userRole]?></h3>

<form method="post" action="../scripts/controllers/logoutController.php">
    <input type="submit" name="submit" value="Logout">
</form>