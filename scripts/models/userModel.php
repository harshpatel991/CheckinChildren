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

    public function isValid(){
        return 'asd';
    }

    public function __construct( $email, $password, $role, $id=""){
        $this->id=$id;
        $this->email=$email;
        $this->role=$role;
        $this->id=$id;
    }
}