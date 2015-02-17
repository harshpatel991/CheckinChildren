<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2/16/15
 * Time: 7:04 PM
 */

require_once(dirname(__FILE__).'/../../scripts/models/dao/employeeDAO.php');

class employeeDAOTest extends PHPUnit_Framework_TestCase {

    public function testFind(){
        $employeeDAO=new employeeDAO();

        $employee=$employeeDAO->find(2);

        $this->assertEquals($employee->name, "Matt Wallick");
        $this->assertEquals($employee->id, 2);
        $this->assertEquals($employee->email, "baba_ganush2@gmail.com");
        $this->assertEquals($employee->password, "2aa60a8ff7fcd473d321e0146afd9e26df395147");
    }
}
