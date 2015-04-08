<?php

require_once dirname(__FILE__).'/../SeleniumTestBase.php';
require_once dirname(__FILE__).'/../TestMacros.php';

class CompanyTest extends SeleniumTestBase
{
    public function setUp(){
        parent::setUp();
    }

    public function testViewFacility() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("signed-in")->assert_text("Currently signed in as a company");

        $this->get_element("name=view_facilities")->click();
        $page = $this->driver->get_source();
        $this->assertContains("My Facilities", $page);
        $this->assertContains("2 Facility Rd. Champaign IL 61820", $page);

        $this->get_element("link=2 Facility Rd. Champaign IL 61820")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Facility ID: 2", $page);
        $this->assertContains("Company ID: 1", $page);
        $this->assertContains("Address: 2 Facility Rd. Champaign IL 61820", $page);
        $this->assertContains("Phone: 1235933945", $page);
    }

    public function testCreateNewFacility() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("name=view_facilities")->click();
        $this->get_element("name=new_facility")->click();

        $this->get_element("name=address")->send_keys("1091 Huntington Rd Carol Stream Il 60082");
        $this->get_element("name=phone_number")->send_keys("8472728096");
        $this->get_element("name=submit")->click();

        $page = $this->driver->get_source();

        //assert that the single facility page is shown
        $this->assertContains("Address: 1091 Huntington Rd Carol Stream Il 60082", $page);
        $this->assertContains("Phone: 8472728096", $page);

        //assert that the new facility is shown in the facilities list
        $this->get_element("name=view_facilities")->click();
        $page = $this->driver->get_source();

        $this->assertContains("1091 Huntington Rd Carol Stream Il 60082", $page);

    }

    public function testViewManagers() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("signed-in")->assert_text("Currently signed in as a company");

        $this->get_element("name=view_managers")->click();
        $page = $this->driver->get_source();
        $this->assertContains("Managers", $page);
        $this->assertContains("Bob Dude", $page);
        $this->assertContains("Rick Grimes", $page);
        $this->assertContains("1", $page);
        $this->assertContains("2", $page);
    }

    public function testCreateNewManager() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("name=view_managers")->click();
        $this->get_element("name=create_manager")->click();

        $this->get_element("name=name")->send_keys("Test Man");
        $this->get_element("name=facility_id")->send_keys("1");
        $this->get_element("name=email")->send_keys("test@mail.com");
        $this->get_element("name=password")->send_keys("password1");
        $this->get_element("name=submit")->click();

        $page = $this->driver->get_source();

        //assert that the single facility page is shown
        $this->assertContains("Test Man", $page);
        $this->assertContains("1", $page);
    }

    public function testCreateNewInvalidManager() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("name=view_managers")->click();
        $this->get_element("link=Create A New Manager")->click();

        $this->get_element("name=name")->send_keys("Test Man");
        $this->get_element("name=facility_id")->send_keys("123");
        $this->get_element("name=email")->send_keys("test@mail.com");
        $this->get_element("name=password")->send_keys("password1");
        $this->get_element("name=submit")->click();

        $page = $this->driver->get_source();

        //assert that the single facility page is shown
        $this->assertContains("Facility not found", $page);
    }

    public function tearDown(){
        parent::tearDown();
    }
}