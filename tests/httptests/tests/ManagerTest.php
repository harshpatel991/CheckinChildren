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
        $this->get_element("name=view_employees")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Matt Wallick", $page);
    }

    public function testMakeEmployee(){
        testMacros::login($this->driver, "manager6@gmail.com", "password6");

        $this->get_element("name=view_employees")->click();
        $this->get_element("name=create_employee")->click();

        $this->get_element("name=name")->send_keys("Test Case");
        $this->get_element("name=email")->send_keys("testcase@gmail.com");
        $this->get_element("name=password")->send_keys("100pass");

        $this->get_element("name=submit")->click();

        $this->get_element("name=back_home")->click();

        $this->get_element("name=profile")->click();
        $this->get_element("name=logout")->click(); //click logout

        //Now to sign is as our new employee
        testMacros::login($this->driver, "testcase@gmail.com", "100pass");

        $this->get_element("id=signed-in")->assert_text("Currently signed in as a employee");

    }

    public function testPromoteEmployee(){
        testMacros::login($this->driver, "manager6@gmail.com", "password6");

        $this->get_element("name=view_employees")->click();
        $this->get_element("id=2")->click();

        $page=$this->driver->get_source();
        $this->assertContains('<td id="emp_status">employee</td>', $page);

        $this->get_element("id=promote_employee")->click();
        $page=$this->driver->get_source();
        $this->assertContains('<td id="emp_status">manager</td>', $page);
    }

    public function testViewEmployeeInfo(){
        testMacros::login($this->driver, "manager6@gmail.com", "password6");

        $this->get_element("name=view_employees")->click();
        $this->get_element("id=2")->click();

        $page=$this->driver->get_source();

        $this->assertContains('<td id="emp_status">employee</td>', $page);
        $this->assertContains('<td id="emp_name">Matt Wallick</td>', $page);
        $this->assertContains('<td id="emp_email">baba_ganush2@gmail.com</td>', $page);

    }

    public function tearDown(){
        //Any additional teardown goes here.
        parent::tearDown();
    }
    public function testMakeEmployeeInvalid(){
        testMacros::login($this->driver, "manager6@gmail.com", "password6");

        $this->get_element("name=view_employees")->click();
        $this->get_element("name=create_employee")->click();

        $this->get_element("name=name")->send_keys("");
        $this->get_element("name=email")->send_keys("testcase@gmail.com");
        $this->get_element("name=password")->send_keys("100pass");

        $this->get_element("name=submit")->click();

        $error_msg = $this->get_element("id=error_message")->get_text();
        $this->assertContains("Invalid Name", $error_msg);

    }

    public function testMakeEmployeeWithPhoneAndAddress(){
        testMacros::login($this->driver, "manager6@gmail.com", "password6");

        $this->get_element("name=view_employees")->click();
        $this->get_element("name=create_employee")->click();

        $this->get_element("name=name")->send_keys("Test Case");
        $this->get_element("name=email")->send_keys("testcase@gmail.com");
        $this->get_element("name=password")->send_keys("100pass");
        $this->get_element("name=phone_number")->send_keys("0123456789");
        $this->get_element("name=address")->send_keys("123 fake street");

        $this->get_element("name=submit")->click();

        $this->get_element("name=back_home")->click();

        $this->get_element("name=profile")->click();
        $this->get_element("name=logout")->click(); //click logout

        //Now to sign is as our new employee
        testMacros::login($this->driver, "testcase@gmail.com", "100pass");

        $this->get_element("id=signed-in")->assert_text("Currently signed in as a employee");
        $this->get_element("id=edit_employee")->click();

        $page = $this->driver->get_source();
        $this->assertContains("0123456789", $page);
        $this->assertContains("123 fake street", $page);
    }

    public function testMakeEmployeeWithInvalidPhone(){
        testMacros::login($this->driver, "manager6@gmail.com", "password6");

        $this->get_element("name=view_employees")->click();
        $this->get_element("name=create_employee")->click();

        $this->get_element("name=name")->send_keys("Test Case");
        $this->get_element("name=email")->send_keys("testcase@gmail.com");
        $this->get_element("name=password")->send_keys("100pass");
        $this->get_element("name=phone_number")->send_keys("012345678");
        $this->get_element("name=address")->send_keys("123 fake street");

        $this->get_element("name=submit")->click();


        $page = $this->driver->get_source();
        $this->assertContains("Invalid Phone Number (must be 10 digits)", $page);
    }
}