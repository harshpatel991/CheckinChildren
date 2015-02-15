<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2/15/15
 * Time: 1:23 PM
 */

class employeeDao {

    //TODO: Use cache to reduce DB calls.
    private static $employeeCache = array();
    private $connection;

    public function __construct()
    {
        $connection = DbConnectionFactory::create();
    }

    public function find($id)
    {
        $query = "t";
        $this->$connection->prepare($query);
        $this->$connection->execute($query);
    }

    public function save($user){
        $query = "";
        $this->$connection->prepare($query);
        $this->$connection->execute($query);
    }
}