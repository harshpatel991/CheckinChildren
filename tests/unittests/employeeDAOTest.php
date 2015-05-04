<?php

require_once(dirname(__FILE__).'/../../scripts/models/dao/employeeDAO.php');
require_once(dirname(__FILE__).'/../../scripts/models/dao/userDAO.php');
require_once(dirname(__FILE__).'/UnitTestBase.php');

/**
 * Class employeeDAOTest test employeeDAO
 */
class employeeDAOTest extends unitTestBase {

    /**
     * Test find employee
     */
    public function testFind(){
        $employeeDAO=new employeeDAO();

        $employee=$employeeDAO->find(2);

        $this->assertEquals($employee->emp_name, "Matt Wallick");
        $this->assertEquals($employee->facility_id, "1");
        $this->assertEquals($employee->id, 2);
        $this->assertEquals($employee->email, "baba_ganush2@gmail.com");
        $this->assertEquals($employee->password, "2aa60a8ff7fcd473d321e0146afd9e26df395147");
    }

    /**
     * Test create employee
     */
    public function testCreate_DCP(){
        $employeeDAO=new employeeDAO();

        $emp1= new employeeModel("Carl Frederickson", sha1("testpass"), 2,"test@email.com", "employee");
        $emp1id=$employeeDAO->create_DCP($emp1);

        $employee=$employeeDAO->find($emp1id);

        $this->assertEquals($employee->emp_name, "Carl Frederickson");
        $this->assertEquals($employee->facility_id, "2");
        $this->assertEquals($employee->id, $emp1id);
        $this->assertEquals($employee->email, "test@email.com");
        $this->assertEquals($employee->password, sha1("testpass"));
    }

    /**
     * Test find with bad id
     */
    public function testBadEmpID()
    {
        $employeeDAO=new employeeDAO();

        $employee=$employeeDAO->find(87998);

        $this->assertFalse($employee);
    }

    /**
     * Test get employees from facility
     */
    public function testgetMultipleFacilityEmployees()
    {
        $employeeDAO = new employeeDAO();

        $employeelist2 = $employeeDAO->getFacilityEmployees(6);

        $names = array("Harsh Patel", "Sterling Archer", "Alex Trebeck");
        foreach ($employeelist2 as $employee) {

            $this->assertTrue(in_array($employee->emp_name, $names));
        }
    }

    /**
     * Tst delete all employees from facility
     */
    public function testDeleteAllEmployeesInFacility(){

        $employeeDAO = new employeeDAO();
        $employees = $employeeDAO->getFacilityEmployees(5);
        $this->assertEquals(2,count($employees));

        $employeeDAO->delete("facility_id",5);

        $employees = $employeeDAO->getFacilityEmployees(5);
        $this->assertEquals(0,count($employees));
    }

    /**
     * Test delete employee
     */
    public function testDeleteExistingEmployee(){
        $employeeDAO = new employeeDAO();
        $userDAO = new userDAO();
        $employeeDAO->delete("id", 2);
        $userDAO->delete(2);

        $employees = $employeeDAO->find(2);

        $this->assertEquals(false, $employees);
    }

    /**
     * Test delete non existing employee
     */
    public function testDeleteNonExistingEmployee(){
        $employeeDAO = new employeeDAO();
        $userDAO = new userDAO();
        $employeeDAO->delete("id", 2123);
        $userDAO->delete(2123);

        $employees = $employeeDAO->find(2123);

        $this->assertEquals(false, $employees);
    }

}
