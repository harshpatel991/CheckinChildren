<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 2/15/15
 * Time: 4:38 PM
 */

/**
 * This controller checks login credentials. If they are valid, the user moves on to the website.
 */
require_once(dirname(__FILE__) . '/../models/dao/userDAO.php');
require_once(dirname(__FILE__).'/../models/userModel.php');
require_once(dirname(__FILE__).'/../cookieManager.php');

$email = $_POST['email'];
$password = $_POST['password'];

$userDao = new UserDAO();
$dbUser = $userDao->find('email', $email);
$cookieManager = new cookieManager();

if (!isset($dbUser) || !$dbUser){ //If it's not a valid user...
    //Failure: user does not exist..
    $cookieManager->clearAuthCookies();
    header("Location: ../../public/login.php"); //get outta here!
    exit;
}

$hashPass = userModel::genHashPassword($password);
if ($hashPass !== $dbUser->password){ //If the password is wrong...
    //Failure: incorrect password..
    $cookieManager->clearAuthCookies();
    header("Location: ../../public/login.php"); //get outta here
    exit;
}

$token = $dbUser->genAuthToken();
$userDao->updateField($dbUser->id, 'auth_token', $token);
$dbUser->auth_token = $token;

$cookieManager->setAuthCookies($dbUser); //set the cookie before moving on

//Success: redirect
header("Location: ../../public/index.php");
