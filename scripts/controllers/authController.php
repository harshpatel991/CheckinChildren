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


if (!isset($_COOKIE[cookieManager::$authToken]) || !isset($_COOKIE[cookieManager::$userId]) || !isset($_COOKIE[cookieManager::$userRole])){
    //Not logged in, reditect to login page
    header("Location: login.php");
    cookieManager::clearAuthCookies();
    exit();
}

$authToken = $_COOKIE[cookieManager::$authToken];
$userId = $_COOKIE[cookieManager::$userId];
$userRole = $_COOKIE[cookieManager::$userRole];

$userDao = new UserDAO();
$user = $userDao->find('id', $userId);

$authenticated = isset($user) && isset($user->auth_token) && $user->auth_token === $authToken
    && isset($user->role) && $user->role === $userRole;

if (!$authenticated){
    //Problem with auth, redirect to error page
    cookieManager::clearAuthCookies();
    header("Location: authError.php");
    exit;
}