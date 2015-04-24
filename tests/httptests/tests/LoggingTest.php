<?php
require_once dirname(__FILE__).'/../SeleniumTestBase.php';
require_once dirname(__FILE__).'/../TestMacros.php';

class LoggingTest extends SeleniumTestBase {

    public function setUp(){
        parent::setUp();

    }

    public function testFilterAllLogs() {
        //Edit employee log
        testMacros::login($this->driver, "baba_ganush2@gmail.com", "password2");
        $this->get_element("id=edit_employee")->click();
        $this->get_element("id=employee_name")->clear(); //clear text input box
        $this->get_element("id=employee_name")->send_keys("Pierce Hawthorn");
        $this->get_element("id=email")->clear();
        $this->get_element("id=email")->send_keys("pHawthorn@gmail.com");
        $this->get_element("name=submit")->click();
        $this->get_element("name=profile")->click();
        $this->get_element("name=logout")->click();

        //Create child log
        testMacros::login($this->driver, "manager6@gmail.com", "password6");
        $this->get_element("name=create_child")->click();
        $this->get_element("name=name")->send_keys("Test Case1");
        $this->get_element("name=PID")->select2("Big Daddy (parent8@gmail.com)");
        $this->get_element("name=aller")->send_keys("many");
        $this->get_element("name=submit")->click();

        //Create parent log
        $this->get_element("name=create_parent")->click();
        $this->get_element("name=name")->send_keys("Test Case1");
        $this->get_element("name=email")->send_keys("testcase1@gmail.com");
        $this->get_element("name=password")->send_keys("password1");
        $this->get_element("name=phone")->send_keys("8008881111");
        $this->get_element("name=addr")->send_keys("1 fake addr");
        $this->get_element("name=carrier")->select_option("Verizon Wireless");
        $this->get_element("name=submit")->click();
        //Create employee log
        $this->get_element("name=view_employees")->click();
        $this->get_element("name=create_employee")->click();
        $this->get_element("name=name")->send_keys("Test Case");
        $this->get_element("name=email")->send_keys("testcase@gmail.com");
        $this->get_element("name=password")->send_keys("100pass");
        $this->get_element("name=submit")->click();

        //promote employee log
        $this->get_element("name=view_employees")->click();
        $this->get_element("id=2")->click();
        $this->get_element("id=promote_employee")->click();

        //Check in/checkout log
        $this->get_element("name=view_children")->click();
        $this->get_element("id=ci-0")->click();
        $this->get_element("id=Submit")->click();
        $this->get_element("id=modal-submit")->clickByJs();
        $this->get_element("name=view_children")->click();
        $this->get_element("id=co-0")->click();
        $this->get_element("id=Submit")->click();
        $this->get_element("id=modal-submit")->clickByJs();

        $this->get_element("name=display_logs")->click(); //go to logs

        //Filter by Child Checked in
        $this->get_element("name=filterBy")->select_option("Child Checked In");
        $this->get_element("name=submit")->click();
        $page=$this->driver->get_source();
        $this->assertEquals(2, substr_count($page, "Child Checked In"));
        $this->assertEquals(1, substr_count($page, "Child Checked Out")); //assert that these only occur once (in the drop down menu)
        $this->assertEquals(1, substr_count($page, "Child Created"));
        $this->assertEquals(1, substr_count($page, "Employee Created"));
        $this->assertEquals(1, substr_count($page, "Parent Created"));
        $this->assertEquals(1, substr_count($page, "Employee Promoted"));
        $this->assertEquals(1, substr_count($page, "Employee Edited"));

        //Filter by Child Checked out
        $this->get_element("name=filterBy")->select_option("Child Checked Out");
        $this->get_element("name=submit")->click();
        $page=$this->driver->get_source();
        $this->assertEquals(2, substr_count($page, "Child Checked Out"));
        $this->assertEquals(1, substr_count($page, "Child Checked In")); //assert that these only occur once (in the drop down menu)
        $this->assertEquals(1, substr_count($page, "Child Created"));
        $this->assertEquals(1, substr_count($page, "Employee Created"));
        $this->assertEquals(1, substr_count($page, "Parent Created"));
        $this->assertEquals(1, substr_count($page, "Employee Promoted"));
        $this->assertEquals(1, substr_count($page, "Employee Edited"));

        //Filter by Child Created
        $this->get_element("name=filterBy")->select_option("Child Created");
        $this->get_element("name=submit")->click();
        $page=$this->driver->get_source();
        $this->assertEquals(2, substr_count($page, "Child Created"));
        $this->assertEquals(1, substr_count($page, "Child Checked Out")); //assert that these only occur once (in the drop down menu)
        $this->assertEquals(1, substr_count($page, "Child Checked In"));
        $this->assertEquals(1, substr_count($page, "Employee Created"));
        $this->assertEquals(1, substr_count($page, "Parent Created"));
        $this->assertEquals(1, substr_count($page, "Employee Promoted"));
        $this->assertEquals(1, substr_count($page, "Employee Edited"));

        //Filter by Employee Created
        $this->get_element("name=filterBy")->select_option("Employee Created");
        $this->get_element("name=submit")->click();
        $page=$this->driver->get_source();
        $this->assertEquals(2, substr_count($page, "Employee Created"));
        $this->assertEquals(1, substr_count($page, "Child Checked Out")); //assert that these only occur once (in the drop down menu)
        $this->assertEquals(1, substr_count($page, "Child Created"));
        $this->assertEquals(1, substr_count($page, "Child Checked In"));
        $this->assertEquals(1, substr_count($page, "Parent Created"));
        $this->assertEquals(1, substr_count($page, "Employee Promoted"));
        $this->assertEquals(1, substr_count($page, "Employee Edited"));

        //Filter by Parent Created
        $this->get_element("name=filterBy")->select_option("Parent Created");
        $this->get_element("name=submit")->click();
        $page=$this->driver->get_source();
        $this->assertEquals(2, substr_count($page, "Parent Created"));
        $this->assertEquals(1, substr_count($page, "Child Checked Out")); //assert that these only occur once (in the drop down menu)
        $this->assertEquals(1, substr_count($page, "Child Created"));
        $this->assertEquals(1, substr_count($page, "Employee Created"));
        $this->assertEquals(1, substr_count($page, "Child Checked In"));
        $this->assertEquals(1, substr_count($page, "Employee Promoted"));
        $this->assertEquals(1, substr_count($page, "Employee Edited"));

        //Filter by Employee Promoted
        $this->get_element("name=filterBy")->select_option("Employee Promoted");
        $this->get_element("name=submit")->click();
        $page=$this->driver->get_source();
        $this->assertEquals(2, substr_count($page, "Employee Promoted"));
        $this->assertEquals(1, substr_count($page, "Child Checked Out")); //assert that these only occur once (in the drop down menu)
        $this->assertEquals(1, substr_count($page, "Child Created"));
        $this->assertEquals(1, substr_count($page, "Employee Created"));
        $this->assertEquals(1, substr_count($page, "Parent Created"));
        $this->assertEquals(1, substr_count($page, "Child Checked In"));
        $this->assertEquals(1, substr_count($page, "Employee Edited"));

        //Filter by Employee Edited
        $this->get_element("name=filterBy")->select_option("Employee Edited");
        $this->get_element("name=submit")->click();
        $page=$this->driver->get_source();
        $this->assertEquals(2, substr_count($page, "Employee Edited"));
        $this->assertEquals(1, substr_count($page, "Child Checked Out")); //assert that these only occur once (in the drop down menu)
        $this->assertEquals(1, substr_count($page, "Child Created"));
        $this->assertEquals(1, substr_count($page, "Employee Created"));
        $this->assertEquals(1, substr_count($page, "Parent Created"));
        $this->assertEquals(1, substr_count($page, "Employee Promoted"));
        $this->assertEquals(1, substr_count($page, "Child Checked In"));
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
        $this->assertContains("Matt Wallick", $page);
    }

    public function testCheckInCheckOutLog() {
        testMacros::login($this->driver, "manager6@gmail.com", "password6");

        $this->get_element("name=view_children")->click();

        $this->get_element("id=ci-0")->click();
        $this->get_element("id=saveButton")->click();
        $this->driver->get_all_elements("name=checkinActor[]")[0]->send_keys('Test Guardian1');
        $this->get_element("id=modal-submit")->clickByJs();

        $this->get_element("name=display_logs")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Child Checked In", $page);
        $this->assertContains("Bob Dude", $page);
        $this->assertContains("Mark Zuckerberg", $page);
        $this->assertContains("Test Guardian1", $page);

        $this->get_element("name=view_children")->click();
        $this->get_element("id=co-0")->click();
        $this->get_element("id=saveButton")->click();
        $this->driver->get_all_elements("name=checkoutActor[]")[0]->send_keys('Test Guardian2');
        $this->get_element("id=modal-submit")->clickByJs();

        $this->get_element("name=display_logs")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Child Checked Out", $page);
        $this->assertContains("Bob Dude", $page);
        $this->assertContains("Mark Zuckerberg", $page);
        $this->assertContains("Test Guardian2", $page);
    }

    public function tearDown()
    {
        //Any additional teardown goes here.
        parent::tearDown();
    }
}