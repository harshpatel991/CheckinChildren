<?php
/**
 * The form handler when a parent submits form to edit a child account
 * Determines if submitted child is valid and updates record in childDAO and redirects to displayChild page
 * If child information is not valid, redirects to editChild page with error
 */

require_once(dirname(__FILE__) . '/../../cookieManager.php');
require_once(dirname(__FILE__) . '/../../models/dao/childDAO.php');
require_once(dirname(__FILE__) . '/../../dateTimeProvider.php');

//Read in POST data from form
$child_id = $_POST['child_id'];

$child = new childModel($_COOKIE[cookieManager::$userId], $_POST["child_name"], $_POST["allergies"],  $_POST["trusted_parties"], 0, $child_id); // set 0 for values that cannot be changed
for ($i=0; $i<7; $i++){
    $child->expect_checkin[$i] = dateTimeProvider::minutesFromMidnight($_POST['ci-'.$i]);
    $child->expect_checkout[$i] = dateTimeProvider::minutesFromMidnight($_POST['co-'.$i]);
}

if ($child->isUpdateValid()) {
    $childDAO = new ChildDAO();
    $childDAO->update($child);

    header("Location: ../../../public/displayChild.php?child_id=".$child_id); //send browser to the page for newly created facility
    exit();

} else { //redirect to edit child page with error message
    header("Location: ../../../public/editChild.php?child_id=".$child_id. "&error=1");
    exit();
}