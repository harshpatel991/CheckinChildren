<?php
/**
 * Created by PhpStorm.
 * User: matt
 */

require_once(dirname(__FILE__).'/../db/dbCredentials.php');

class DbConnectionFactory
{
    public static function create()
    {
        return new PDO(DbCredentials::$dbName, DbCredentials::$username, DbCredentials::$password);
    }
}