<?php

/**
 * The form handler when a company submits form to create a new parent account
 * Determines if submitted parent is valid and adds to parentDAO and redirects to index page
 * If parent information is not valid, redirects to createParent page with error
 */

require_once(dirname(__FILE__) . '/../authController.php');
require_once(dirname(__FILE__) . '/../../errorManager.php');
require_once(dirname(__FILE__) . '/../../models/dao/parentDAO.php');
require_once(dirname(__FILE__) . '/../../models/dao/logDAO.php');
require_once(dirname(__FILE__) . '/../../models/parentModel.php');
require_once(dirname(__FILE__) . '/../../cookieManager.php');
require_once(dirname(__FILE__) . '/../managerController.php');
require_once(dirname(__FILE__) . '/../../models/dao/logDAO.php');

$authController = new authController();
$authController->verifyRole(['employee','manager']);
$authController->redirectPage('../../../public/');

$cookieManager = new cookieManager();
$cookies = $cookieManager->getCookies();

$manCon=new managerController();

$hashedPassword = employeeModel::genHashPassword($_POST['password']);
$parent=new parentModel($_POST['name'], $hashedPassword, $_POST['email'], "parent", $_POST['phone'],$_POST['carrier'], $_POST['addr']);

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

//Retreive POST data from form submit
$parent=new parentModel($_POST['name'], $hashedPassword, $_POST['email'], "parent", $_POST['phone'], $_POST['addr'], $contact_string);
$lDAO=new logDAO();

$error_code = $parent->isValid();
if ($error_code===0) {
    $parentDAO=new parentDAO();
    $pid=$parentDAO->create_parent($parent);
    $lDAO->insert($cookies[cookieManager::$userId], $pid, $parent->parent_name, logDAO::$parentCreated);
    header("Location: ../../../public/index.php"); //redirect to the index page
    exit();
} else {
    $lDAO->insert($cookies[cookieManager::$userId], null, $parent->parent_name, logDAO::$parentCreated, "Error: ".errorManager::getErrorMessage($error_code));
    header("Location: ../../../public/createParent.php?error=".$error_code); //redirect back to the createParent page with appropriate error
    exit();
}