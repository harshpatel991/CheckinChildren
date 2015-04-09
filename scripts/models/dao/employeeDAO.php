<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2/15/15
 * Time: 1:23 PM
 */

require_once(dirname(__FILE__).'/../employeeModel.php');
require_once(dirname(__FILE__).'/../db/dbConnectionFactory.php');
require_once(dirname(__FILE__).'/userDAO.php');
class employeeDAO {

    public function __construct()
    { }

    public function find($id){
        $connection = DbConnectionFactory::create();
        $query = "SELECT * FROM employee NATURAL JOIN users WHERE id=:id";

        $stmt=$connection->prepare($query);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'employeeModel'); //MAY NEED FETCH_PROPS_LATE FLAG. see below
        $emp=$stmt->fetch();
        $connection=null;

        return $emp;
    }

    public function create_DCP($employee){
        $newEmployee=new userModel($employee->email, $employee->password, $employee->role);
        $userDAO=new userDAO();

        $id=$userDAO->insert($newEmployee);

        $this->insert($employee->emp_name, $employee->facility_id, $id);

        return $id;
    }

    private function insert( $emp_name, $facility_id, $id){
        $connection = DbConnectionFactory::create();

        $query = "INSERT INTO employee (emp_name, facility_id, id) VALUES ( :emp_name, :facility_id, :id)";
        $stmt=$connection->prepare($query);

        $stmt->bindParam(":facility_id", $facility_id);
        $stmt->bindParam(":emp_name", $emp_name);
        $stmt->bindParam(":id", $id);

        $stmt->execute();

        $connection=null;
    }

    public function getFacilityEmployees($facility_id){
        $connection=DbConnectionFactory::create();

        $query = "SELECT * FROM employee WHERE facility_id = :facility_id ORDER BY emp_name ASC";
        $stmt=$connection->prepare($query);

        $stmt->bindParam(":facility_id",$facility_id);

        $stmt->execute();

        $employees = $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'employeeModel');
        $connection=null;

        return $employees;

    }

    /**
     *
     * @param $employee
     * // **** ONLY UPDATES EMAIL AND NAME! ****
     */
    public function update($employee){
        $connection=DbConnectionFactory::create();

        $query = 'UPDATE employee SET emp_name=:emp_name WHERE id=:id';
        $stmt=$connection->prepare($query);

        $stmt->bindParam(":emp_name", $employee->emp_name);
        $stmt->bindParam(":id", $employee->id);

        $stmt->execute();

        $query="UPDATE users SET email=:email WHERE id=:id";
        $stmt=$connection->prepare($query);

        $stmt->bindParam(":email", $employee->email);
        $stmt->bindParam(":id", $employee->id);

        $stmt->execute();

        $connection=null;
    }

    public function delete($field, $value){
        $connection = DbConnectionFactory::create();
        $query = "DELETE FROM employee WHERE ".$field."=:id";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $value);
        $stmt->execute();
        $connection = null;
    }
}