<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2/18/15
 * Time: 8:34 PM
 */

require_once 'SeleniumTestBase.php';

class EmployeeTest extends SeleniumTestBase {

    public function setUp(){
        //Any additional setup goes here.
        parent::setUp();
    }

    public function testEmployeeLogin() {
        $this->get_element("name=email")->send_keys("baba_ganush2@gmail.com");
        $this->get_element("name=password")->send_keys("password2");
        $this->get_element("name=submit")->click();

        $this->get_element("id=signed-in")->assert_text("Currently signed in as a employee");
        //TODO: Finish this test case.
    }

    public function tearDown(){
        //Any additional teardown goes here.
        parent::tearDown();
    }
}