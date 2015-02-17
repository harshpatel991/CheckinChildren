<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 2/16/15
 * Time: 4:25 AM
 */

class cookieManager
{
    public static $authToken = 'auth_token';
    public static $userId = 'user_id';
    public static $userRole = 'user_role';

    public static function setAuthCookies(userModel $user){
        $cookie_exp = time()+60*60*24*30; #30 days
        setcookie(self::$userId, $user->id, $cookie_exp, '/');
        setcookie(self::$authToken, $user->auth_token, $cookie_exp, '/');
        setcookie(self::$userRole, $user->role, $cookie_exp, '/');
    }

    public static function clearAuthCookies(){
        $cookie_exp = time() - 60;
        setcookie(self::$userId, '', $cookie_exp, '/');
        setcookie(self::$authToken, '', $cookie_exp, '/');
        setcookie(self::$userRole, '', $cookie_exp, '/');
    }
}