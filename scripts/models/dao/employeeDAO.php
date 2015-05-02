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

/**
 * Class employeeDAO manages employee table in database
 */
class employeeDAO {

    /**
     * Default constructor
     */
    public function __construct()
    { }

    /**
     * Retrieve employee with a given id
     * @param int $id Employee id
     * @return mixed Employee with a given id
     */
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

    /**
     * Adds new employee with given data to users table
     * @param employeeModel $employee New employee model
     * @return string Assigned id for new employee
     */
    public function create_DCP($employee){
        $newEmployee=new userModel($employee->email, $employee->password, $employee->role);
        $userDAO=new userDAO();

        $id=$userDAO->insert($newEmployee);

        $this->insert($employee->emp_name, $employee->facility_id, $id, $employee->phone_number, $employee->address);

        return $id;
    }

    /**
     * Inserts new employee into employee table
     * @param string $emp_name Employee name
     * @param int $facility_id Facility id
     * @param int $id
     * @param $phone_number
     * @param $address
     */
    private function insert( $emp_name, $facility_id, $id, $phone_number, $address){
        $connection = DbConnectionFactory::create();

        $query = "INSERT INTO employee (emp_name, facility_id, id, phone_number, address) VALUES ( :emp_name, :facility_id, :id, :phone_number, :address)";
        $stmt=$connection->prepare($query);

        $stmt->bindParam(":facility_id", $facility_id);
        $stmt->bindParam(":emp_name", $emp_name);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":phone_number", $phone_number);
        $stmt->bindParam(":address", $address);

        $stmt->execute();

        $connection=null;
    }

    /**
     * Get all employees from facility
     * @param int $facility_id Facility id
     * @return array Array of employees
     */
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
     * Update employee with given id
     * @param $employee Updated employee model
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

        $query="UPDATE employee SET phone_number=:phone_number, address=:address WHERE id=:id";
        $stmt=$connection->prepare($query);

        $stmt->bindParam(":phone_number", $employee->phone_number);
        $stmt->bindParam(":address", $employee->address);
        $stmt->bindParam(":id", $employee->id);

        $stmt->execute();


        $connection=null;
    }

    /**
     * Delete employee with given field and value
     * @param string $field Field
     * @param string $value Value
     */
    public function delete($field, $value){
        $connection = DbConnectionFactory::create();
        $query = "DELETE FROM employee WHERE ".$field."=:id";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $value);
        $stmt->execute();
        $connection = null;
    }

    /**
     * Update field with value
     * @param int $id Id
     * @param string $field Field
     * @param string $value Value
     */
    public function updateField($id, $field, $value){
        $connection = DbConnectionFactory::create();
        $query = 'UPDATE employee SET '.$field.'=:value WHERE id=:id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $connection = null;
    }
}