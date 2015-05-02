<?php

require_once(dirname(__FILE__).'/../employeeModel.php');
require_once(dirname(__FILE__).'/../db/dbConnectionFactory.php');
require_once(dirname(__FILE__).'/userDAO.php');

/**
 * Class managerDAO manages employee table for managers
 */
class managerDAO {

    /**
     * Default constructor
     */
    public function __construct()
    { }

    /**
     * Retrieve manager with id
     * @param int $id Manager Id
     * @return mixed Retrieved Manager Model
     */
    public function find($id){
        $connection = DbConnectionFactory::create();
        $query = "SELECT * FROM employee NATURAL JOIN users WHERE id=:id";

        $stmt=$connection->prepare($query);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'managerModel'); //MAY NEED FETCH_PROPS_LATE FLAG. see below
        $emp=$stmt->fetch();
        $connection=null;

        return $emp;
    }

    /**
     * Creates manager
     * @param managerModel $manager New Manager model
     * @return string Id assigned to new manager
     */
    public function createManager($manager){
        $newManager=new userModel($manager->email, $manager->password, $manager->role);
        $userDAO=new userDAO();

        $id=$userDAO->insert($newManager);

        $this->insert($manager->emp_name, $manager->facility_id, $id, $manager->phone_number, $manager->address);

        return $id;
    }

    /**
     * Insert manager to employee table
     * @param string $emp_name Manager name
     * @param int $facility_id Facility id
     * @param int $id Id
     * @param string $phone_number Manager phone number
     * @param string $address Manager address
     */
    private function insert( $emp_name, $facility_id, $id, $phone_number, $address){
        $connection = DbConnectionFactory::create();

        $query = "INSERT INTO employee (emp_name, facility_id, id, address, phone_number) VALUES ( :emp_name, :facility_id, :id, :address, :phone_number)";
        $stmt=$connection->prepare($query);

        $stmt->bindParam(":facility_id", $facility_id);
        $stmt->bindParam(":emp_name", $emp_name);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":phone_number", $phone_number);

        $stmt->execute();

        $connection=null;
    }

    /**
     * Get manger in a facility
     * @param int $facility_id Facility id
     * @return array Array of Managers
     */
    public function getFacilityManagers($facility_id){
        $connection=DbConnectionFactory::create();

        $query = "SELECT employee.id, employee.emp_name, employee.facility_id FROM employee RIGHT JOIN users ON employee.id = users.id AND users.role='manager' WHERE employee.facility_id = :facility_id ORDER BY emp_name ASC";
        $stmt=$connection->prepare($query);

        $stmt->bindParam(":facility_id",$facility_id);

        $stmt->execute();

        $managers = $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'managerModel');
        $connection=null;

        return $managers;

    }

    /**
     * Get all managers that belong to the company
     * @param int $company_id Company id
     * @return array Array of Managers
     */
    public function getCompanyManagers($company_id){
        $connection=DbConnectionFactory::create();

        $query = "select employee.id, employee.emp_name, employee.facility_id from users left join employee on users.id = employee.id left join facility on facility.facility_id=employee.facility_id where users.role = 'manager' and facility.company_id = :company_id ORDER BY emp_name ASC";
        $stmt=$connection->prepare($query);

        $stmt->bindParam(":company_id",$company_id);

        $stmt->execute();

        $managers = $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'managerModel');
        $connection=null;

        return $managers;

    }
}