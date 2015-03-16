<?php

require_once(dirname(__FILE__) . '/../../cookieManager.php');
require_once(dirname(__FILE__) . '/../../models/dao/parentDAO.php');

//Read in POST data from form
$parent_id = $_COOKIE[cookieManager::$userId];

//Store the contact preferences in a string
$contact_string="";
$texts=$_POST['texting'];
$emails=$_POST['emailing'];
if (!empty($texts)){
    $contact_string.=$texts;
    if (!empty($emails)){
        $contact_string.=',';
    }
}
if (!empty($emails)){
    $contact_string.=$emails;
}

$parent = new parentModel($_POST["parent_name"],"", $_POST["email"], "parent", $_POST["phone_number"], $_POST["address"], $contact_string, $_POST['carrier'], $parent_id);

if ($parent->isUpdateValid()) {
    $parentDAO = new ParentDAO();
    $parentDAO->update($parent);

    header("Location: ../../../public/displayParentInfo.php"); //send browser to the page for newly created facility
    exit();

} else { //redirect to employee creation page with error message
    header("Location: ../../../public/editParent.php?error=1");
    exit();
}
