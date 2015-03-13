<?php
error_reporting(E_ALL); //turn on error reporting
ini_set("display_errors", 1);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <?php require_once(dirname(__FILE__).'/importBoostrap.php'); ?>
    </head>

    <?php require_once(dirname(__FILE__) . '/../scripts/views/navBarView.php'); ?>

    <body>
        <div class="container-fluid">
            <div class="row classroom">
                <div class="col-sm-12 col-lg-8 col-lg-offset-2">
                    <h1>
                    PEACE <br>
                    OF <br>
                    MIND <br>
                    </h1>
                </div>
            </div>

            <div class="row classroom-explanation">
                <div class="col-sm-12 col-lg-8 col-lg-offset-2">
                    <h3>Checkin Children provides you with the assurance that your child is safe and sound.</h3>
                </div>
            </div>

            <div class="row classroom-icons-wrapper">
                <div class="col-sm-12 col-md-3 col-lg-2 col-lg-offset-2">
                    <img src="../images/Clipboard.png" width="150"> <br>
                    Notifications when your child is checked in and out
                </div>
                <hr class="visible-xs-block visible-sm-block">
                <div class="col-sm-12 col-md-3 col-lg-2">
                    <img src="../images/Calendar.png" width="150"> <br>
                    Specify who is allowed to pick up your child
                </div>
                <hr class="visible-xs-block visible-sm-block">
                <div class="col-sm-12 col-md-3 col-lg-2">
                    <img src="../images/Mail.png" width="150"> <br>
                    Notifications when your child has not been picked up
                </div>
                <hr class="visible-xs-block visible-sm-block">
                <div class="col-sm-12 col-md-3 col-lg-2">
                    <img src="../images/Chat.png" width="150"> <br>
                    Notify the facility when you will pick your child up
                </div>
            </div>

            <div class="row businesses">
                <div class="col-sm-12 col-lg-8 col-lg-offset-2">
                    <h3>Own a day care facility? <br> See how Checkin Children can stream line your management and make it easier to do what you love</h3>
                    <a class="btn btn-default  btn-lg" href="#">Create a Company Account</a>
                </div>
            </div>

            <div class="row classroom-explanation">
                <div class="col-sm-12 col-lg-8 col-lg-offset-2">
                    <h3>We provide the tools your business needs to succeed.</h3>
                </div>
            </div>

            <div class="row bussiness-icons-wrapper">

                <div class="col-sm-12 col-md-3 col-lg-2 col-lg-offset-2 ">
                    <img src="../images/Book.png" width="150"> <br>
                    Checkin Children will help any size daycare facility's management structure
                </div>
                <hr class="visible-xs-block visible-sm-block">
                <div class="col-sm-12 col-md-3 col-lg-2 ">
                    <img src="../images/Pensils.png" width="150"> <br>
                    Keep track of your facilities, manager, and employees
                </div>
                <hr class="visible-xs-block visible-sm-block">
                <div class="col-sm-12 col-md-3 col-lg-2 ">
                    <img src="../images/Retina-Ready.png" width="150"> <br>
                    Track incoming and outgoing children with an intuitive user interface
                </div>
                <hr class="visible-xs-block visible-sm-block">
                <div class="col-sm-12 col-md-3 col-lg-2 ">
                    <img src="../images/Watches.png" width="150"> <br>
                    Give your customers real-time feed back on the status of their children
                </div>
            </div>

            <!-- Login Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Login</h4>
                        </div>
                        <div class="modal-body">
                            <?php require_once(dirname(__FILE__).'/../scripts/views/loginView.php'); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>

    <?php require_once(dirname(__FILE__) . '/../scripts/views/footerView.php'); ?>

</html>

