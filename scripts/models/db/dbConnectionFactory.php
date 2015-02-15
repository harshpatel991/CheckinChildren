<?php
/**
 * Created by PhpStorm.
 * User: matt
 */

class DbConnectionFactory
{
    public static function create()
    {
        return new PDO('mysql:host=localhost;dbname='.DbCredentials::$dbName, DbCredentials::$username, DbCredentials::$password);
    }
}