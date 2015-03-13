<?php
require_once(dirname(__FILE__).'/../cookieManager.php');
?>

<div class="container-fluid">
<div class="row">
  <div class="col-sm-12 col-lg-8 col-lg-offset-2">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Checkin Children</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse-1">

          <ul class="nav navbar-nav navbar-right">
            <?php if (isset($_COOKIE[cookieManager::$userRole])) { //TODO: is this okay to do? ?>
              <li><p class="navbar-text">Logged in as a <b><?php echo $_COOKIE[cookieManager::$userRole]; ?></b></p></li>
              <li><p class="navbar-text">ID: <?php echo $_COOKIE[cookieManager::$userId]; ?> </p></li>


              <li class="dropdown">
                <button href="#" class="dropdown-toggle btn btn-default navbar-btn" data-toggle="dropdown" role="button" aria-expanded="false">
                  <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Profile
                <span class="caret"></span></button>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="../scripts/controllers/logoutController.php">Logout</a></li>
                </ul>
              </li>

            <?php } else { ?>
              <li><button type="button" class="btn btn-primary navbar-btn" data-toggle="modal" data-target="#myModal" name="login">Login</button></li>
              <li><button href="#" type="button" class="btn btn-default navbar-btn">Sign Up</button></li>
            <?php } ?>

          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </div>
</div>
</div>

