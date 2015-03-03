<?php

require_once(dirname(__FILE__).'/../cookieManager.php');
require_once(dirname(__FILE__).'/../dateTimeProvider.php');
require_once(dirname(__FILE__).'/../models/childModel.php');
require_once(dirname(__FILE__).'/../controllers/authController.php');


/*$childList="";
$childCount = 0;
foreach ($children as $child) {
    $childList .= '<button type=button class="btn btn-primary" id="btn_chld'.$child->child_id. '">' . ($child->child_name). "</button>";
    if ($childCount++ % 2 == 0){
        $childList .= '<br>';
    }
}*/


echo getAccordion();
?>
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
                    <li id="modal-ci-0" class="hidden">Doug Stamper</li>
                    <li id="modal-ci-3" class="hidden">Rachel Posner</li>
                </ul>
                <p id="modal-co-number">You are about to check-out # children:</p>
                <ul id="co-list">
                    <li id="modal-co-1" class="hidden">Frank Underwood</li>
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
<div class="panel-group" id="accordion">
         <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Doug Stamper</a>
                    <button type="button" id="ci-0" class="btn btn-primary btn-ci btn-sm pull-right" value="0" data-toggle="button">Check-In </button>
                </h4>
            </div>
            <div id="collapse1" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>Some info about Doug Stamper</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Rachel Posner</a>
                    <button type="button" id="ci-3" class="btn btn-primary btn-ci btn-sm pull-right" value="3" data-toggle="button">Check-In </button>
                </h4>
            </div>
            <div id="collapse2" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>Some info about Rachel Posner</p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Frank Underwood</a>
                    <button type="button" id="co-1" class="btn btn-primary btn-co btn-sm pull-right" value="1" data-toggle="button">Check-Out</button>
                </h4>
            </div>
            <div id="collapse3" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>Some info about Frank Underwood</p>
                </div>
            </div>
        </div>
    </div>
HTML;

}