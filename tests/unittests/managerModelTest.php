<?php

require_once(dirname(__FILE__).'/../../scripts/models/managerModel.php');
require_once(dirname(__FILE__).'/UnitTestBase.php');

class managerModelTest extends unitTestBase {

    private $name = "test1";
    private $password = "pass1";
    private $facilityId = 1;
    private $email = "test1@email.com";
    private $role = "manager";
    private $id = 3;

    //Test constructor
    public function testConstructor() {
        $manager = new managerModel($this->name, $this->password, $this->facilityId, $this->email, $this->id);
        $this->assertEquals($this->name, $manager->emp_name);
        $this->assertEquals($this->password, $manager->password);
        $this->assertEquals($this->facilityId, $manager->facility_id);
        $this->assertEquals($this->email, $manager->email);
        $this->assertEquals($this->role, $manager->role);
        $this->assertEquals($this->id, $manager->id);
    }

    public function testConstructorWithoutId() {
        $manager = new managerModel($this->name, $this->password, $this->facilityId, $this->email);
        $this->assertEquals($this->name, $manager->emp_name);
        $this->assertEquals($this->password, $manager->password);
        $this->assertEquals($this->facilityId, $manager->facility_id);
        $this->assertEquals($this->email, $manager->email);
        $this->assertEquals($this->role, $manager->role);
        $this->assertEquals(0, $manager->id);
    }

    public function checkIsValidEmptyName(){
        $manager = new managerModel("", $this->password, $this->facilityId, $this->email, $this->id);
        $this->assertFalse($manager->isValid());
    }

    public function checkIsValidEmptyPassword(){
        $manager = new managerModel($this->name, "", $this->facilityId, $this->email, $this->id);
        $this->assertFalse($manager->isValid());
    }

    public function checkIsValidLongName(){
        $manager = new managerModel("aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa", $this->password, $this->facilityId, $this->email, $this->id);
        $this->assertFalse($manager->isValid());
    }

    public function checkIsValidLongEmail(){
        $manager = new managerModel($this->name, $this->password, $this->facilityId, "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa", $this->id);
        $this->assertFalse($manager->isValid());
    }

    public function checkIsValidLongPassword(){
        $manager = new managerModel($this->name, "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa", $this->facilityId, $this->email, $this->id);
        $this->assertFalse($manager->isValid());
    }
}
