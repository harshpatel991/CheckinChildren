<?php

require_once(dirname(__FILE__).'/../db/dbCredentials.php');

/**
 * Class DbConnectionFactory
 *
 * Creates a database connection with credentials.
 */
class DbConnectionFactory
{
    /**
     * Create a new database connection using static credentials.
     *
     * @return PDO The database connection.
     */
    public static function create()
    {
        return new PDO(DbCredentials::$dbName, DbCredentials::$username, DbCredentials::$password);
    }
}