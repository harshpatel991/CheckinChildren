<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 2/15/15
 * Time: 4:38 PM
 */

require_once(dirname(__FILE__) . '/../models/dao/userDAO.php');

$userDao = new UserDAO();
$user = new User();
$user->email='m@test.com';
$user->password = 'fakepass';
$user->role='employee';
$id = $userDao->insert($user);
echo $id;
echo "<br>";
var_dump($userDao->find($id));