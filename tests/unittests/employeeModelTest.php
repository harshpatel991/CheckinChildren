<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2/16/15
 * Time: 10:42 PM
 */

require_once(dirname(__FILE__).'/../../scripts/models/employeeModel.php');
require_once(dirname(__FILE__).'/UnitTestBase.php');

class employeeModelTest extends unitTestBase {

    public function testConstructor(){
        $employee=new employeeModel("Herbert", "hello", 34, "test@test.com", "employee", 45);

        $this->assertEquals("Herbert", $employee->emp_name);
        $this->assertEquals("hello", $employee->password);
        $this->assertEquals(34, $employee->facility_id);
        $this->assertEquals("test@test.com", $employee->email);
        $this->assertEquals("employee", $employee->role);
        $this->assertEquals(45, $employee->id);
    }

    public function testFilter(){
        $employee=new employeeModel("", "hello", 34, "test@test.com", "employee", 45);

        $this->assertEquals($employee->isValid(), errorEnum::invalid_name);

        $employee->emp_name="Herbert";

        $this->assertEquals($employee->isValid(), 0);

        $employee->emp_name="kadjflkfjsdklfjsdlfkjakslfjkdlasfjklajsdflkdjfklasdfjdskajlfkajsfdlfkjdaslfjlasdfkja";

        $this->assertEquals($employee->isValid(), errorEnum::invalid_name);
    }

}
