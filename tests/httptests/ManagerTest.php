<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2/18/15
 * Time: 8:43 PM
 */

require_once 'SeleniumTestBase.php';

class ManagerTest extends SeleniumTestBase {

    public function setUp(){
        //Any additional setup goes here.
        parent::setUp();
    }

    public function testEmployeeList() {
        $this->get_element("name=email")->send_keys("manager6@gmail.com");
        $this->get_element("name=password")->send_keys("password6");
        $this->get_element("name=submit")->click();

        $this->get_element("id=display_employee")->click();

        $this->get_element("employees")->assert_text("Bob Dude\nMatt Wallick");
        //$page=$this->driver->get_source();
        //$this->assertContains("Balh blah blah", $page);
    }

    public function testMakeEmployee(){
        $this->get_element("name=email")->send_keys("manager6@gmail.com");
        $this->get_element("name=password")->send_keys("password6");
        $this->get_element("name=submit")->click();

        $this->get_element("id=display_employee")->click();
        $this->get_element("link=Create A New Employee")->click();


        $this->get_element("name=name")->send_keys("Test Case");
        $this->get_element("name=email")->send_keys("testcase@gmail.com");
        $this->get_element("name=password")->send_keys("100pass");

        $this->get_element("name=submit")->click();

        $this->get_element("link=Back to home")->click();

        $this->get_element("name=submit")->click();

        //Now to sign is as our new employee
        $this->get_element("name=email")->send_keys("testcase@gmail.com");
        $this->get_element("name=password")->send_keys("100pass");
        $this->get_element("name=submit")->click();

        $this->get_element("id=signed-in")->assert_text("Currently signed in as a employee");

    }

    public function tearDown(){
        //Any additional teardown goes here.
        parent::tearDown();
    }

}