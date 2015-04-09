<?php

require_once dirname(__FILE__).'/../SeleniumTestBase.php';
require_once dirname(__FILE__).'/../TestMacros.php';

class createChildTest extends SeleniumTestBase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function testManagerCreateChildValid()
    {

        testMacros::login($this->driver, "manager6@gmail.com", "password6");

        $this->get_element("name=create_child")->click();

        $this->get_element("name=name")->send_keys("Test Case1");
        $this->get_element("name=PID")->select2("Big Daddy (parent8@gmail.com)");
        $this->get_element("name=aller")->send_keys("many");
        $this->get_element("name=submit")->click();


        $this->get_element("id=signed-in")->assert_text("Currently signed in as a manager");

    }

    public function testEmployeeMakeChildValidAndInvalid()
    {
        testMacros::login($this->driver, "employee4@gmail.com", "password4");

        $this->get_element("name=create_child")->click();


        $this->get_element("name=name")->send_keys("Test Case1");
        $this->get_element("name=PID")->select2("Big Daddy (parent8@gmail.com)");
        $this->get_element("name=aller")->send_keys("many");
        $this->get_element("name=trusted_parties")->send_keys("Anyone");
        $this->get_element("name=submit")->click();

        $this->get_element("id=signed-in")->assert_text("Currently signed in as a employee");

        $this->get_element("name=create_child")->click();

        $this->get_element("name=name")->send_keys("Test Case1");
        $this->get_element("name=PID")->select2("invalid");
        $this->get_element("name=aller")->send_keys("many");
        $this->get_element("name=submit")->click();

        //assert that the single facility page is shown
        $error_msg = $this->get_element("id=error_message")->get_text();
        $this->assertContains("Parent not found", $error_msg);

    }

    public function tearDown()
    {
        //Any additional teardown goes here.
        parent::tearDown();
    }
}