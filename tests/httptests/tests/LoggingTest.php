<?php
require_once dirname(__FILE__).'/../SeleniumTestBase.php';
require_once dirname(__FILE__).'/../TestMacros.php';

class LoggingTest extends SeleniumTestBase {

    public function setUp(){
        parent::setUp();

    }

    public function testCreateChildLog(){

        testMacros::login($this->driver, "manager6@gmail.com", "password6");

        $this->get_element("name=create_child")->click();

        $this->get_element("name=name")->send_keys("Test Case1");
        $this->get_element("name=PID")->select2("Big Daddy (parent8@gmail.com)");
        $this->get_element("name=aller")->send_keys("many");
        $this->get_element("name=submit")->click();

        $this->get_element("name=display_logs")->click();

        $page=$this->driver->get_source();

        $this->assertContains("Test Case1", $page);
        $this->assertContains("Child Created", $page);
    }

    public function testCreateParentLog(){

        testMacros::login($this->driver, "manager6@gmail.com", "password6");

        $this->get_element("name=create_parent")->click();

        $this->get_element("name=name")->send_keys("Test Case1");
        $this->get_element("name=email")->send_keys("testcase1@gmail.com");
        $this->get_element("name=password")->send_keys("password1");
        $this->get_element("name=phone")->send_keys("8008881111");
        $this->get_element("name=addr")->send_keys("1 fake addr");
        $this->get_element("name=carrier")->select_option("Verizon Wireless");
        $this->get_element("name=submit")->click();

        $this->get_element("name=display_logs")->click();

        $page=$this->driver->get_source();

        $this->assertContains("Test Case1", $page);
        $this->assertContains("Parent Created", $page);
    }

    public function testCreateEmployeeLog(){
        testMacros::login($this->driver, "manager6@gmail.com", "password6");

        $this->get_element("name=view_employees")->click();
        $this->get_element("name=create_employee")->click();

        $this->get_element("name=name")->send_keys("Test Case");
        $this->get_element("name=email")->send_keys("testcase@gmail.com");
        $this->get_element("name=password")->send_keys("100pass");

        $this->get_element("name=submit")->click();

        $this->get_element("name=display_logs")->click();

        $page=$this->driver->get_source();

        $this->assertContains("Test Case", $page);
        $this->assertContains("Employee Created", $page);
    }

    public function testEditEmployeeLog(){
        testMacros::login($this->driver, "baba_ganush2@gmail.com", "password2");

        $this->get_element("id=edit_employee")->click();

        $this->get_element("id=employee_name")->clear(); //clear text input box
        $this->get_element("id=employee_name")->send_keys("Pierce Hawthorn");

        $this->get_element("id=email")->clear();
        $this->get_element("id=email")->send_keys("pHawthorn@gmail.com");

        $this->get_element("name=submit")->click();

        $this->get_element("name=profile")->click();
        $this->get_element("name=logout")->click();

        testMacros::login($this->driver, "manager6@gmail.com", "password6");

        $this->get_element("name=display_logs")->click();

        $page=$this->driver->get_source();

        $this->assertContains("Pierce Hawthorn", $page);
        $this->assertContains("Employee Edited", $page);

    }

    public function testPromoteEmployeeLog(){
        testMacros::login($this->driver, "manager6@gmail.com", "password6");

        $this->get_element("name=view_employees")->click();
        $this->get_element("id=2")->click();
        $this->get_element("id=promote_employee")->click();

        $this->get_element("name=display_logs")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Employee Promoted", $page);
        $this->assertContains("Bob Dude", $page);
        $this->assertContains("Matt Wallick", $page);
    }

    public function testCheckInCheckOutLog() {
        testMacros::login($this->driver, "manager6@gmail.com", "password6");

        $this->get_element("name=view_children")->click();

        $this->get_element("id=ci-0")->click();
        $this->get_element("id=Submit")->click();
        $this->get_element("id=modal-submit")->clickByJs();

        $this->get_element("name=display_logs")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Child Checked In", $page);
        $this->assertContains("Bob Dude", $page);
        $this->assertContains("Mark Zuckerberg", $page);

        $this->get_element("name=view_children")->click();
        $this->get_element("id=co-0")->click();
        $this->get_element("id=Submit")->click();
        $this->get_element("id=modal-submit")->clickByJs();

        $this->get_element("name=display_logs")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Child Checked Out", $page);
        $this->assertContains("Bob Dude", $page);
        $this->assertContains("Mark Zuckerberg", $page);
    }

    public function tearDown()
    {
        //Any additional teardown goes here.
        parent::tearDown();
    }
}