<?php
/**
 * Created by PhpStorm.
 * User: matt
 */

require_once(dirname(__FILE__).'/../../../config.php');

class DbCredentials
{
    public static $dbName = "";
    public static $username = "root";
    public static $password = "";
}

DbCredentials::$dbName='mysql:host='.Config::$config["dbhost"].';dbname='.Config::$config['dbname'];