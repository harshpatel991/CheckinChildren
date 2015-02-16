<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 2/16/15
 * Time: 4:11 AM
 */

require_once(dirname(__FILE__) . '/../models/dao/userDAO.php');
require_once(dirname(__FILE__).'/../models/userModel.php');
require_once(dirname(__FILE__).'/../cookieManager.php');

$authToken = $_COOKIE[cookieManager::$authToken];
$userId = $_COOKIE[cookieManager::$userId];
$userRole = $_COOKIE[cookieManager::$userRole];


if (!isset($userId) || !isset($authToken)){
    //Not logged in, reditect to login page
    cookieManager::clearAuthCookies();
    echo 'not logged in';
}

$userDao = new UserDAO();
$user = $userDao->find('id', $userId);

$authenticated = isset($user) && isset($user->auth_token) && $user->auth_token === $authToken
    && isset($user->role) && $user->role === $userRole;

if (!$authenticated){
    //Problem with auth, redirect to error page
    cookieManager::clearAuthCookies();
    echo 'bad auth';
}
else{
    echo 'logged in';
}