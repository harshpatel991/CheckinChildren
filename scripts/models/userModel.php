<?php
/**
 * Created by PhpStorm.
 * User: matt
 */

class userModel
{
    public $id;
    public $email;
    public $password;
    public $role;
    public $auth_token;

    private static $privateKey = 'd@t$yuk';

    public function isValid(){
        return 'asd';
    }


    public function __construct( $email="", $password="", $role="", $id=""){
        $this->password=$password;
        $this->email=$email;
        $this->role=$role;
        $this->id=$id;
    }

    public static function genHashPassword($password){
        return sha1($password);
    }

    public function genAuthToken(){
        //TODO: This is not exactly a great algorithm, revise in the future.
        //TODO: Require time expiration logic.
        $token = $_SERVER['HTTP_USER_AGENT'] . $this->password . $this->genRandomStr();
        return sha1($token);

    }

    private function genRandomStr($len = 10){
        $numChars = strlen(self::$privateKey);
        $randStr = '';
        for ($i=0; $i<$len; $i++){
            $randStr .= self::$privateKey[rand(0, $numChars-1)];
        }
        return $randStr;
    }
}