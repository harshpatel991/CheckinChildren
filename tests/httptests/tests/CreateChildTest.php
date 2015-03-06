<?php


require_once dirname(__FILE__).'/../SeleniumTestBase.php';

class createChildTest extends SeleniumTestBase
{

    public function setUp()
    {
        //Any additional setup goes here.
        parent::setUp();
    }

    public function testManagerCreateChildValid()
    {
        $this->get_element("name=email")->send_keys("manager6@gmail.com");
        $this->get_element("name=password")->send_keys("password6");
        $this->get_element("name=submit")->click();

        $this->get_element("id=create_child")->click();

        $this->get_element("name=name")->send_keys("Test Case1");
        $this->get_element("name=PID")->send_keys("8");
        $this->get_element("name=aller")->send_keys("many");
        $this->get_element("name=submit")->click();


        $this->get_element("id=signed-in")->assert_text("Currently signed in as a manager");

    }

    public function testEmployeeMakeChildValidAndInvalid()
    {
        $this->get_element("name=email")->send_keys("employee4@gmail.com");
        $this->get_element("name=password")->send_keys("password4");
        $this->get_element("name=submit")->click();

        $this->get_element("id=create_child")->click();


        $this->get_element("name=name")->send_keys("Test Case1");
        $this->get_element("name=PID")->send_keys("8");
        $this->get_element("name=aller")->send_keys("many");
        $this->get_element("name=submit")->click();


        $this->get_element("id=signed-in")->assert_text("Currently signed in as a employee");


        $this->get_element("id=create_child")->click();

        $this->get_element("name=name")->send_keys("Test Case1");
        $this->get_element("name=PID")->send_keys("999");
        $this->get_element("name=aller")->send_keys("many");
        $this->get_element("name=submit")->click();


        $page = $this->driver->get_source();

        //assert that the single facility page is shown
        $this->assertContains("Invalid information", $page);

    }

    public function tearDown()
    {
        //Any additional teardown goes here.
        parent::tearDown();
    }
}