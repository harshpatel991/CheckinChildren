<?php

/**
 * Class userModel used a base representation for all user. Super class to many other models
 */
class userModel
{
    public $id;
    public $email;
    public $password;
    public $role;
    public $auth_token;
    public $address;
    public $phone_number;

    private static $privateKey = 'd@t$yuk';

    /**
     * Checks if a user is valid
     * @return int either 0 for good or some other error code
     */
    public function isValid(){
        $errorCode = $this->isUpdateValid();
        if($errorCode>0) {
            return $errorCode;
        }
        if(strlen($this->password)<=0) { //in an update, password is allowed to be length 0
            return errorEnum::invalid_password;
        }

        return 0;
    }

    /**
     * Checks if an update to a user is valid
     * @return int either 0 for good or some other error code
     */
    public function isUpdateValid() {
        if (strlen($this->email)>40 || strlen($this->email)<=0 || strpos($this->email, '@')===false) {
            return errorEnum::invalid_email;
        }

        if (strlen($this->phone_number)!=10 || !is_numeric($this->phone_number)){
            return errorEnum::invalid_phone;
        }
        if (strlen($this->address)>50){
            return errorEnum::invalid_address;
        }

        return 0;
    }

    /**
     * Cosntructs a new user
     * @param string $email their email
     * @param string $password their password
     * @param string $role their role
     * @param string $id a unique identifier
     */
    public function __construct( $email="", $password="", $role="", $id=""){
        $this->password=$password;
        $this->email=$email;
        $this->role=$role;
        $this->id=$id;
    }

    /**
     * Returns a hashed password
     * @param string $password not hashed
     * @return string hashed version of the password
     */
    public static function genHashPassword($password){
        return sha1($password);
    }

    /**
     * returns the authentication token for that user
     * @return string the token
     */
    public function genAuthToken(){
        //TODO: This is not exactly a great algorithm, revise in the future.
        //TODO: Require time expiration logic.
        $token = $_SERVER['HTTP_USER_AGENT'] . $this->password . $this->genRandomStr();
        return sha1($token);

    }

    /**
     * gets a random string
     * @param int $len length of the string
     * @return string
     */
    private function genRandomStr($len = 10){
        $numChars = strlen(self::$privateKey);
        $randStr = '';
        for ($i=0; $i<$len; $i++){
            $randStr .= self::$privateKey[rand(0, $numChars-1)];
        }
        return $randStr;
    }
}