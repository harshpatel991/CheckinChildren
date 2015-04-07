<?php
/**
 * The form handler when a parent submits form to edit their account
 * Determines if submitted parent is valid and updates record in parentDAO and redirects to displayParentInfo page
 * If parent information is not valid, redirects to editParent page with error
 */

require_once(dirname(__FILE__) . '/../../cookieManager.php');
require_once(dirname(__FILE__) . '/../../models/dao/parentDAO.php');

//Read in POST data from form
$parent_id = $_COOKIE[cookieManager::$userId];

//Store the contact preferences in a string
$contact_string="";
if (isset($_POST['texting'])){
    $contact_string.=$_POST['texting'];
    if (isset($_POST['emailing'])){
        $contact_string.=',';
    }
}
if (isset($_POST['emailing'])){
    $contact_string.=$_POST['emailing'];
}

$parent = new parentModel($_POST["parent_name"],"", $_POST["email"], "parent", $_POST["phone_number"], $_POST["address"], $contact_string, $_POST['carrier'], $parent_id);

$error_code = $parent->isUpdateValid();
if ($error_code === 0) {
    $parentDAO = new ParentDAO();
    $parentDAO->update($parent);

    header("Location: ../../../public/displayParentInfo.php"); //send browser to the page for newly created facility
    exit();
} else {
    header("Location: ../../../public/editParent.php?error=".$error_code); //redirect to employee creation page with error message
    exit();
}
