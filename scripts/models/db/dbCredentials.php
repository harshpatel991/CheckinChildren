<?php

require_once(dirname(__FILE__).'/../../../config.php');

/**
 * Class DbCredentials
 *
 * Contains credentials for logging into the database.
 */
class DbCredentials
{
    public static $dbName = "";
    public static $username = "root";
    public static $password = "";
}

// Set by config.php file
DbCredentials::$dbName='mysql:host='.Config::$config["dbhost"].';dbname='.Config::$config['dbname'];