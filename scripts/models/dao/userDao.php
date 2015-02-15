<?php
/**
 * Created by PhpStorm.
 * User: matt
 */

class UserDAO
{
    //TODO: Use cache to reduce DB calls.
    private static $userCache = array();
    private $connection;

    public function __construct()
    {
        $connection = DbConnectionFactory::create();
    }

    public function find($id)
    {
        $query = "";
        $this->$connection->prepare($query);
        $this->$connection->execute($query);
    }

    public function save($user){
        $query = "";
        $this->$connection->prepare($query);
        $this->$connection->execute($query);
    }
}