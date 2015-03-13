<?php
/**
 * Created by PhpStorm.
 * User: Elzabad
 * Date: 2/26/2015
 * Time: 7:44 PM
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once(dirname(__FILE__).'/../../cookieManager.php');
require_once(dirname(__FILE__).'/../../controllers/authController.php');
require_once(dirname(__FILE__). '/../../models/dao/userDAO.php');
require_once(dirname(__FILE__). '/../../models/userModel.php');

$userDAO=new userDAO();
$user=$userDAO->find("id", $_COOKIE[cookieManager::$userId]);

$oldPassword = userModel::genHashPassword($_POST['old_password']);
$newPassword = userModel::genHashPassword($_POST['new_password']);
$conPassword = userModel::genHashPassword($_POST['con_password']);

if($oldPassword != $user->password) {
    header("Location: ../../../public/updatePassword.php?error=2");
    exit();
} else if($newPassword != $conPassword) {
    header("Location: ../../../public/updatePassword.php?error=3");
    exit();
} else {
    $user->auth_token = $user->genAuthToken();
    $userDAO->updateField($user->id, "password", $newPassword);
    $userDAO->updateField($user->id, "auth_token", $user->auth_token);
    cookieManager::setAuthCookies($user);
    header("Location: ../../../public/index.php");
}