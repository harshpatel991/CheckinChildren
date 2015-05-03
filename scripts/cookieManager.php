<?php

class cookieManager
{
    public static $authToken = 'auth_token';
    public static $userId = 'user_id';
    public static $userRole = 'user_role';

    public function getCookies(){
        return $_COOKIE;
    }

    public function setCookie($name, $value, $expire, $domain){
        setcookie($name, $value, $expire, $domain);
    }

    public function setAuthCookies(userModel $user){
        $cookie_exp = time()+60*60*24*30; #30 days
        $this->setCookie(self::$userId, $user->id, $cookie_exp, '/');
        $this->setCookie(self::$authToken, $user->auth_token, $cookie_exp, '/');
        $this->setCookie(self::$userRole, $user->role, $cookie_exp, '/');
    }

    public function clearAuthCookies(){
        var_dump(time());
        $cookie_exp = time() - 60;
        $this->setCookie(self::$userId, '', $cookie_exp, '/');
        $this->setCookie(self::$authToken, '', $cookie_exp, '/');
        $this->setCookie(self::$userRole, '', $cookie_exp, '/');
    }
}