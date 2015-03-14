<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2/15/15
 * Time: 8:15 PM
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once(dirname(__FILE__) . '/../../models/dao/parentDAO.php');
require_once(dirname(__FILE__) . '/../../models/parentModel.php');
require_once(dirname(__FILE__) . '/../../cookieManager.php');
require_once(dirname(__FILE__) . '/../managerController.php');

$manCon=new managerController();

$hashedPassword = employeeModel::genHashPassword($_POST['password']);

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
$parent=new parentModel($_POST['name'], $hashedPassword, $_POST['email'], "parent", $_POST['phone'], $_POST['addr'], $contact_string);


if ($parent->isValid()) {
    $parentDAO=new parentDAO();

    $parentDAO->create_parent($parent);

    header("Location: ../../../public/index.php");
    exit();
}

else{

   header("Location: ../../../public/createParent.php?error=1");

}