<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 2/15/15
 * Time: 4:38 PM
 */

require_once(dirname(__FILE__) . '/../models/dao/userDAO.php');
require_once(dirname(__FILE__).'/../models/userModel.php');
require_once(dirname(__FILE__).'/../cookieManager.php');

$email = $_POST['email'];
$password = $_POST['password'];

$userDao = new UserDAO();
$dbUser = $userDao->find('email', $email);

if (!isset($dbUser) || !$dbUser){
    //Failure: user does not exist..
    echo 'no user';
    cookieManager::clearAuthCookies();
    exit;
}

$hashPass = userModel::genHashPassword($password);
if ($hashPass !== $dbUser->password){
    //Failure: incorrect password...
    echo 'bad password';
    cookieManager::clearAuthCookies();
    exit;
}

$token = $dbUser->genAuthToken();
$userDao->updateField($dbUser->id, 'auth_token', $token);
$dbUser->auth_token = $token;
var_dump($dbUser);

cookieManager::setAuthCookies($dbUser);

//Success: redirect
echo 'success';
exit;
