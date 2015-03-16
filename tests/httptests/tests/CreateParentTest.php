<?php

require_once dirname(__FILE__).'/../SeleniumTestBase.php';
require_once dirname(__FILE__).'/../TestMacros.php';

class createParentTest extends SeleniumTestBase
{

    public function setUp()
    {
        //Any additional setup goes here.
        parent::setUp();
    }

    public function testManagerCreate()
    {
        testMacros::login($this->driver, "manager6@gmail.com", "password6");

        $this->get_element("name=create_parent")->click();

        $this->get_element("name=name")->send_keys("Test Case1");
        $this->get_element("name=email")->send_keys("testcase1@gmail.com");
        $this->get_element("name=password")->send_keys("password1");
        $this->get_element("name=phone")->send_keys("8008881111");
        $this->get_element("name=addr")->send_keys("1 fake addr");
        $this->get_element("name=submit")->click();


        $this->get_element("id=signed-in")->assert_text("Currently signed in as a manager");

    }

    public function testEmployeeMakeParent()
    {
        testMacros::login($this->driver, "employee4@gmail.com", "password4");

        $this->get_element("name=create_parent")->click();

        $this->get_element("name=name")->send_keys("Test Case2");
        $this->get_element("name=email")->send_keys("testcase2@gmail.com");
        $this->get_element("name=password")->send_keys("password2");
        $this->get_element("name=phone")->send_keys("8008881111");
        $this->get_element("name=addr")->send_keys("2 fake addr");
        $this->get_element("name=emailing")->click();
        $this->get_element("name=submit")->click();


        $this->get_element("id=signed-in")->assert_text("Currently signed in as a employee");

    }

    public function tearDown()
    {
        //Any additional teardown goes here.
        parent::tearDown();
    }
}