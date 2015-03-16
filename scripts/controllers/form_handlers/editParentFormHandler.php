<?php

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

$parent = new parentModel($_POST["parent_name"],"", $_POST["email"], "parent", $_POST["phone_number"], $_POST["address"], $contact_string, $parent_id);

if ($parent->isUpdateValid()) {
    $parentDAO = new ParentDAO();
    $parentDAO->update($parent);

    header("Location: ../../../public/displayParentInfo.php"); //send browser to the page for newly created facility
    exit();

} else { //redirect to employee creation page with error message
    header("Location: ../../../public/editParent.php?error=1");
    exit();
}
