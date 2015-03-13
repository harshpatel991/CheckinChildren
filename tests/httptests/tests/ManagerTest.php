<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2/18/15
 * Time: 8:43 PM
 */

require_once dirname(__FILE__).'/../SeleniumTestBase.php';
require_once dirname(__FILE__).'/../TestMacros.php';

class ManagerTest extends SeleniumTestBase {

    public function setUp(){
        //Any additional setup goes here.
        parent::setUp();
    }

    public function testEmployeeList() {
        testMacros::login($this->driver, "manager6@gmail.com", "password6");
        $this->get_element("link=View My Employees")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Matt Wallick", $page);
        $this->assertContains("Bob Dude", $page);
    }

    public function testMakeEmployee(){
        testMacros::login($this->driver, "manager6@gmail.com", "password6");

        $this->get_element("id=display_employee")->click();
        $this->get_element("link=View My Employees")->click();
        $this->get_element("name=create_employee")->click();

        $this->get_element("name=name")->send_keys("Test Case");
        $this->get_element("name=email")->send_keys("testcase@gmail.com");
        $this->get_element("name=password")->send_keys("100pass");

        $this->get_element("name=submit")->click();

        $this->get_element("name=back_home")->click();

        $this->get_element("name=submit")->click(); //click logout

        //Now to sign is as our new employee
        testMacros::login($this->driver, "testcase@gmail.com", "100pass");

        $this->get_element("id=signed-in")->assert_text("Currently signed in as a employee");

    }

    public function tearDown(){
        //Any additional teardown goes here.
        parent::tearDown();
    }

}