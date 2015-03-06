<?php

require_once(dirname(__FILE__).'/../controllers/authController.php');
require_once(dirname(__FILE__).'/../cookieManager.php');
require_once(dirname(__FILE__).'/../dateTimeProvider.php');
require_once(dirname(__FILE__).'/../models/childModel.php');
require_once(dirname(__FILE__).'/../models/childStatusEnum.php');
require_once(dirname(__FILE__).'/../controllers/checkinController.php');
require_once(dirname(__FILE__).'/../dateTimeProvider.php');

$checkinController = new checkinController();
$children = $checkinController->getChildrenBuckets($_COOKIE[cookieManager::$userId]);
$time = dateTimeProvider::getCurrentDateTime();

?>
<h1>Time: <?php echo dateTimeProvider::readableTime($time); ?></h1>
<h2>Not Here</h2>
<div class="panel-group" id="nothere-accordion">
    <?php
    $i = 0;
    foreach($children[childStatus::not_here_late] as $child){
        echo accordionElement( $i, $child, childStatus::not_here_late);
        $i++;
    }
    foreach($children[childStatus::not_here_due] as $child){
        echo accordionElement( $i, $child, childStatus::not_here_due);
        $i++;
    }
    foreach($children[childStatus::not_here_ok] as $child){
        echo accordionElement( $i, $child, childStatus::not_here_ok);
        $i++;
    }
    ?>
</div>

<h2>Here</h2>
<div class="panel-group" id="here-accordion">
    <?php
    $i = 0;
    foreach($children[childStatus::here_due] as $child){
        echo accordionElement( $i, $child, childStatus::here_due);
        $i++;
    }
    foreach($children[childStatus::here_ok] as $child){
        echo accordionElement( $i, $child, childStatus::here_ok);
        $i++;
    }
    ?>
</div>

<button type="button" id="Submit" class="btn btn-info confirm-submit" data-toggle="modal" data-target="#confirmModal">Submit</button>
<br>
<br><a href="index.php">Back to Home</a>

<!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="confirmModalLabel">Confirm Changes</h4>
                </div>
                <div class="modal-body">
                    <?php
                    $childrenHere = array_merge($children[childStatus::here_due], $children[childStatus::here_ok]);
                    $childrenNotHere = array_merge($children[childStatus::not_here_late], $children[childStatus::not_here_due], $children[childStatus::not_here_ok]);
                    ?>
                    <p id="modal-ci-number">You are about to check-in # children:</p>
                        <ul id="ci-list">
                            <?php
                            foreach($childrenNotHere as $i=>$child){
                                echo '<li id="modal-ci-'.$i.'" class="ci-input hidden" value="'.$child->child_id.'">'.$child->child_name.'</li>';
                            }
                            ?>
                        </ul>
                        <p id="modal-co-number">You are about to check-out # children:</p>
                        <ul id="co-list">
                            <?php
                            foreach($childrenHere as $i=>$child){
                                echo '<li id="modal-co-'.$i.'" class="co-input hidden" value="'.$child->child_id.'">'.$child->child_name.'</li>';
                            }
                            ?>
                        </ul>
                </div>

                <div class="modal-footer">
                    <form name="checkinForm" method="post" action="../scripts/controllers/form_handlers/checkChildInOutFormHandler.php" onsubmit="checkinSubmit();">
                        <p id="checkinInputs" class="hidden"></p>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button id="#modal-submit" type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

<?php

function getAccordionDetails($child, $status){
    $details = array(
        'buttonText' => 'Check-In',
        'hereText' => 'nothere',
        'cico' => 'ci',
        'infoText' => 'problem'
    );

    if ($status === childStatus::not_here_late){
        $details['class'] = 'danger';
        $details['infoText'] = 'LATE: Expected at '.$child->getExpectedCheckin();
    }
    else if ($status === childStatus::not_here_due){
        $details['class'] = 'warning';
        $details['infoText'] = 'Expected at '.$child->getExpectedCheckin();
    }
    else if ($status === childStatus::not_here_ok){
        $details['class'] = 'default';
        $details['infoText'] = 'Checked Out';
    }
    else if ($status === childStatus::here_due){
        $details['class'] = 'danger';
        $details['buttonText'] = 'Check-Out';
        $details['hereText'] = 'here';
        $details['cico'] = 'co';
        $details['infoText'] = 'PARENT LATE: Expected at '.$child->getExpectedCheckout();
    }
    else if ($status === childStatus::here_ok){
        $details['class'] = 'default';
        $details['buttonText'] = 'Check-Out';
        $details['hereText'] = 'here';
        $details['cico'] = 'co';
        $details['infoText'] = 'Parent due at '.$child->getExpectedCheckout();
    }

    return $details;
}

function accordionElement($i, $child, $status){

    $details = getAccordionDetails($child, $status);

    $offer_html = '<div class="panel panel-'.$details['class'].'">';
    $offer_html .= '<div class="panel-heading">';
    $offer_html .= '<h4 class="panel-title">';
    $offer_html .= '<a data-toggle="collapse" data-parent="#accordion" href="#'.$details['hereText'].'-collapse-'.$i.'">'.$child->child_name.'</a>';
    $offer_html .= '<button type="button" id="'.$details['cico'].'-'.$i.'" class="btn btn-primary btn-'.$details['cico'].' btn-sm pull-right" value="'.$i.'" data-toggle="button">'.$details['buttonText'].'</button>';
    $offer_html .= '</h4>';
    $offer_html .= '</div>';
    $offer_html .= '<div id="'.$details['hereText'].'-collapse-'.$i.'" class="panel-collapse collapse">';
    $offer_html .= '<div class="panel-body">';
    $offer_html .= '<p>'.$details['infoText'].'</p>';
    $offer_html .= '</div></div></div>';

    return $offer_html;
}