<?php
/**
 * The form handler when a user submits to update their password
 * Determines if submitted password is valid and updates record in userDAO and redirects to index page
 * If user information is not valid, redirects to updatePassword page with error
 */
require_once(dirname(__FILE__) . '/../authController.php');
require_once(dirname(__FILE__) . '/../../errorManager.php');
require_once(dirname(__FILE__).'/../../cookieManager.php');
require_once(dirname(__FILE__). '/../../models/dao/userDAO.php');
require_once(dirname(__FILE__). '/../../models/userModel.php');

$userDAO=new userDAO();
$user=$userDAO->find("id", $_COOKIE[cookieManager::$userId]);

//Read in POST data
$oldPassword = userModel::genHashPassword($_POST['old_password']);
$newPassword = userModel::genHashPassword($_POST['new_password']);
$conPassword = userModel::genHashPassword($_POST['con_password']);

if($oldPassword != $user->password) { //user is not authorized to perform action
    header("Location: ../../../public/updatePassword.php?error=".errorEnum::password_incorrect);
    exit();
} else if($newPassword != $conPassword) { //user mistyped the new password confirmation
    header("Location: ../../../public/updatePassword.php?error=".errorEnum::password_mismatch);
    exit();
} else { //successfully entered old password and matching new passwords
    $user->auth_token = $user->genAuthToken();
    $userDAO->updateField($user->id, "password", $newPassword);
    $userDAO->updateField($user->id, "auth_token", $user->auth_token);
    cookieManager::setAuthCookies($user);
    header("Location: ../../../public/index.php");
}