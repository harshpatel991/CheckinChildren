<?php
require_once dirname(__FILE__).'/../SeleniumTestBase.php';
require_once dirname(__FILE__).'/../TestMacros.php';

class CompanyTest extends SeleniumTestBase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testEditParent()
    {
        //Login first
        testMacros::login($this->driver, "parent19@gmail.com", "password19");

        $this->get_element("link=View My Profile")->click();
        $this->get_element("link=Edit Information")->click();

        $this->get_element("name=parent_name")->clear(); //clear text input box
        $this->get_element("name=parent_name")->send_keys("New Momma");

        $this->get_element("name=email")->clear();
        $this->get_element("name=email")->send_keys("newmom19@gmail.com");

        $this->get_element("name=address")->clear();
        $this->get_element("name=address")->send_keys("123 New Mom Rd");

        $this->get_element("name=phone_number")->clear();
        $this->get_element("name=phone_number")->send_keys("1231237890");

        $this->get_element("name=submit")->click();

        $page = $this->driver->get_source();
        $this->assertContains("New Momma", $page);
        $this->assertContains("newmom19@gmail.com", $page);
        $this->assertContains("123 New Mom Rd", $page);
        $this->assertContains("1231237890", $page);
    }

    //Attempt to edit parent with an invalid phone number
    public function testEditParentInvalid()
    {
        //Login first
        testMacros::login($this->driver, "parent19@gmail.com", "password19");

        $this->get_element("link=View My Profile")->click();
        $this->get_element("link=Edit Information")->click();

        $this->get_element("name=parent_name")->clear(); //clear text input box
        $this->get_element("name=parent_name")->send_keys("New Momma");

        $this->get_element("name=email")->clear();
        $this->get_element("name=email")->send_keys("newmom19@gmail.com");

        $this->get_element("name=address")->clear();
        $this->get_element("name=address")->send_keys("123 New Mom Rd");

        $this->get_element("name=phone_number")->clear();
        $this->get_element("name=phone_number")->send_keys("12312378901");

        $this->get_element("name=submit")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Invalid Information", $page);
    }

    public function tearDown(){
        parent::tearDown();
    }

}