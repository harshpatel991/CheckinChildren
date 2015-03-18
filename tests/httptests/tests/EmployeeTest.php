<?php
require_once dirname(__FILE__).'/../SeleniumTestBase.php';
require_once dirname(__FILE__).'/../TestMacros.php';

class EmployeeTest extends SeleniumTestBase {

    public function setUp(){
        //Any additional setup goes here.
        parent::setUp();
    }

    public function testEmployeeLogin() {
        testMacros::login($this->driver, "baba_ganush2@gmail.com", "password2");

        $this->get_element("id=signed-in")->assert_text("Currently signed in as a employee");
    }

    public function tearDown(){
        //Any additional teardown goes here.
        parent::tearDown();
    }
}