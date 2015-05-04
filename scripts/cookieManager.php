<?php

/**
 * Class cookieManager
 *
 * Manages access to the browser cookies for a user.
 */
class cookieManager
{
    /**
     * @var string The cookie index of the authentication token.
     */
    public static $authToken = 'auth_token';

    /**
     * @var string The cookie index of the user id.
     */
    public static $userId = 'user_id';

    /**
     * @var string The cookie index of the user role.
     */
    public static $userRole = 'user_role';


    /**
     * Get all current cookies.
     *
     * @return mixed All cookies in use as cookie array.
     */
    public function getCookies(){
        return $_COOKIE;
    }

    /**
     * Set a cookie to a specified value.
     *
     * @param string $name The indexed name of the cookie (should generally use one of the defined constants).
     * @param string $value The value of the cookie to set.
     * @param int $expire The expiration timestamp of the cookie.
     * @param string $domain The domain of the cookie.
     */
    public function setCookie($name, $value, $expire, $domain){
        setcookie($name, $value, $expire, $domain);
    }

    /**
     * Set the necessary authentication cookies for the current user.
     *
     * @param userModel $user The user with current login information.
     */
    public function setAuthCookies(userModel $user){
        $cookie_exp = time()+60*60*24*30; // 30 days
        $this->setCookie(self::$userId, $user->id, $cookie_exp, '/');
        $this->setCookie(self::$authToken, $user->auth_token, $cookie_exp, '/');
        $this->setCookie(self::$userRole, $user->role, $cookie_exp, '/');
    }

    /**
     * Clear the authentication cookies for the current user. Effectively logs the user out of the system.
     */
    public function clearAuthCookies(){
        var_dump(time());
        $cookie_exp = time() - 60;
        $this->setCookie(self::$userId, '', $cookie_exp, '/');
        $this->setCookie(self::$authToken, '', $cookie_exp, '/');
        $this->setCookie(self::$userRole, '', $cookie_exp, '/');
    }
}