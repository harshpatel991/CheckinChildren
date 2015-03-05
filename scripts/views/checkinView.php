<?php

require_once(dirname(__FILE__).'/../controllers/authController.php');
require_once(dirname(__FILE__).'/../cookieManager.php');
require_once(dirname(__FILE__).'/../dateTimeProvider.php');
require_once(dirname(__FILE__).'/../models/childModel.php');
require_once(dirname(__FILE__).'/../controllers/checkinController.php');

$checkinController = new checkinController();
$children = $checkinController->getChildrenBuckets($_COOKIE[cookieManager::$userId]);
?>

<h1>Not Here</h1>
<div class="panel-group" id="nothere-accordion">
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#nothere-collapse-0">Child 3</a>
                <button type="button" id="ci-0" class="btn btn-primary btn-ci btn-sm pull-right" value="0" data-toggle="button">Check-In </button>
            </h4>
        </div>
        <div id="nothere-collapse-0" class="panel-collapse collapse">
            <div class="panel-body">
                <p>Expected Today at 11:30</p>
            </div>
        </div>
    </div>
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#nothere-collapse-1">Child 8</a>
                <button type="button" id="ci-1" class="btn btn-primary btn-ci btn-sm pull-right" value="1" data-toggle="button">Check-In </button>
            </h4>
        </div>
        <div id="nothere-collapse-1" class="panel-collapse collapse">
            <div class="panel-body">
                <p>Expected Today at 11:30</p>
            </div>
        </div>
    </div>
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#nothere-collapse-2">Child 1</a>
                <button type="button" id="ci-2" class="btn btn-primary btn-ci btn-sm pull-right" value="2" data-toggle="button">Check-In </button>
            </h4>
        </div>
        <div id="nothere-collapse-2" class="panel-collapse collapse">
            <div class="panel-body">
                <p>Expected Today at 11:30</p>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#nothere-collapse-3">Child 6</a>
                <button type="button" id="ci-3" class="btn btn-primary btn-ci btn-sm pull-right" value="3" data-toggle="button">Check-In </button>
            </h4>
        </div>
        <div id="nothere-collapse-3" class="panel-collapse collapse">
            <div class="panel-body">
                <p>Expected Today at 11:30</p>
            </div>
        </div>
    </div>
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#nothere-collapse-4">Child 7</a>
                <button type="button" id="ci-4" class="btn btn-primary btn-ci btn-sm pull-right" value="4" data-toggle="button">Check-In </button>
            </h4>
        </div>
        <div id="nothere-collapse-4" class="panel-collapse collapse">
            <div class="panel-body">
                <p>Expected Today at 11:30</p>
            </div>
        </div>
    </div>
</div>


<h1>Here</h1>
<div class="panel-group" id="accordion">
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#here-collapse-0">Child 2</a>
                <button type="button" id="co-0" class="btn btn-primary btn-co btn-sm pull-right" value="0" data-toggle="button">Check-Out </button>
            </h4>
        </div>
        <div id="here-collapse-0" class="panel-collapse collapse">
            <div class="panel-body">
                <p>Arrived Today at 11:30</p>
            </div>
        </div>
    </div>
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#here-collapse-1">Child 4</a>
                <button type="button" id="co-1" class="btn btn-primary btn-co btn-sm pull-right" value="1" data-toggle="button">Check-Out </button>
            </h4>
        </div>
        <div id="here-collapse-1" class="panel-collapse collapse">
            <div class="panel-body">
                <p>Arrived Today at 11:30</p>
            </div>
        </div>
    </div>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#here-collapse-2">Child 5</a>
                <button type="button" id="co-2" class="btn btn-primary btn-co btn-sm pull-right" value="2" data-toggle="button">Check-Out </button>
            </h4>
        </div>
        <div id="here-collapse-2" class="panel-collapse collapse">
            <div class="panel-body">
                <p>Arrived Today at 11:30</p>
            </div>
        </div>
    </div>
    <div class="panel panel-success">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#here-collapse-3">Child 9</a>
                <button type="button" id="co-3" class="btn btn-primary btn-co btn-sm pull-right" value="3" data-toggle="button">Check-Out </button>
            </h4>
        </div>
        <div id="here-collapse-3" class="panel-collapse collapse">
            <div class="panel-body">
                <p>Arrived Today at 11:30</p>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#here-collapse-4">Child 10</a>
                <button type="button" id="co-4" class="btn btn-primary btn-co btn-sm pull-right" value="4" data-toggle="button">Check-Out </button>
            </h4>
        </div>
        <div id="here-collapse-4" class="panel-collapse collapse">
            <div class="panel-body">
                <p>Arrived Today at 11:30</p>
            </div>
        </div>
    </div>
</div>

<button type="button" class="btn btn-info confirm-submit" data-toggle="modal" data-target="#myModal">Submit</button>
<br>
<br><a href="index.php">Back to Home</a>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirm Changes</h4>
            </div>
            <div class="modal-body">
                <p id="modal-ci-number">You are about to check-in # children:</p>
                <ul id="ci-list">
                    <li id="modal-ci-0" class="hidden">Child 3</li>
                    <li id="modal-ci-1" class="hidden">Child 8</li>
                    <li id="modal-ci-2" class="hidden">Child 1</li>
                    <li id="modal-ci-3" class="hidden">Child 6</li>
                    <li id="modal-ci-4" class="hidden">Child 7</li>
                </ul>
                <p id="modal-co-number">You are about to check-out # children:</p>
                <ul id="co-list">
                    <li id="modal-co-0" class="hidden">Child 2</li>
                    <li id="modal-co-1" class="hidden">Child 4</li>
                    <li id="modal-co-2" class="hidden">Child 5</li>
                    <li id="modal-co-3" class="hidden">Child 9</li>
                    <li id="modal-co-4" class="hidden">Child 10</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<?php

function getAccordion(){
    return <<<HTML
<h1>Not Here</h1>

HTML;

}