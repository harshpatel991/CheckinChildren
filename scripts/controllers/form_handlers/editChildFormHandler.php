<?php

require_once(dirname(__FILE__) . '/../../cookieManager.php');
require_once(dirname(__FILE__) . '/../../models/dao/childDAO.php');

//Read in POST data from form
$child_id = $_POST['child_id'];

$child = new childModel($_COOKIE[cookieManager::$userId], $_POST["child_name"], $_POST["allergies"], 0, $child_id); // set 0 for values that cannot be changed

if ($child->isUpdateValid()) {
    $childDAO = new ChildDAO();
    $childDAO->update($child);

    header("Location: ../../../public/displayChild.php?child_id=".$child_id); //send browser to the page for newly created facility
    exit();

} else { //redirect to employee creation page with error message
    header("Location: ../../../public/editChild.php?child_id=".$child_id. "&error=1");
    exit();
}
