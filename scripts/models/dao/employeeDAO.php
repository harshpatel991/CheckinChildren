<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2/15/15
 * Time: 1:23 PM
 */

require_once(dirname(__FILE__).'/../employeeModel.php');
require_once(dirname(__FILE__).'/../dbConnectionFactory.php');
require_once(dirname(__FILE__).'/userDAO');
class employeeDao {

    //TODO: Use cache to reduce DB calls.
    private static $employeeCache = array();

    public function __construct()
    {

    }

    public function find($id){
        $connection = DbConnectionFactory::create();
        $query = "SELECT * FROM employee WHERE id=:id";

        $stmt=$this->$connection->prepare($query);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'employeeModel');
        $emp=$stmt->fetch();
        $connection=null;

        return $emp;
    }

    public function create_employee($email, $password){
        $connection = DbConnectionFactory::create();

        $newUser=new userModel($email, $password, "employee");
        $userDAO=new userDAO();



    }

    private function insert($employee){
        $connection = DbConnectionFactory::create();
        $query = "INSERT INTO employee ";
        $this->$connection->prepare($query);
        $this->$connection->execute($query);
    }
}