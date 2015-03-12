<ul class="list-group">

    <?php if ($_COOKIE[cookieManager::$userRole]=='manager') { ?>


    <?php } else if ($_COOKIE[cookieManager::$userRole]=='employee') { ?>
        <li class="list-group-item">Test5</li>
        <li class="list-group-item">Test6</li>
        <li class="list-group-item">Test7</li>
        <li class="list-group-item">Test8</li>
    <?php } else if ($_COOKIE[cookieManager::$userRole]=='company') { ?>
        <li class="list-group-item"><a href="displayFacilities.php">View My Facilities</a></li>
        <li class="list-group-item"><a href="displayManagers.php">View My Managers</a></li>
    <?php } else if ($_COOKIE[cookieManager::$userRole]=='parent') { ?>
        <li class="list-group-item">Test13</li>
        <li class="list-group-item">Test14</li>
        <li class="list-group-item">Test15</li>
        <li class="list-group-item">Test16</li>
    <?php } ?>

</ul>