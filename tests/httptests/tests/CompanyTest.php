<?php

require_once dirname(__FILE__).'/../SeleniumTestBase.php';

class CompanyTest extends SeleniumTestBase
{
    public function setUp(){
        parent::setUp();
    }



    public function testViewFacility() {
        $this->get_element("name=email")->send_keys("bigcompany1@gmail.com");
        $this->get_element("name=password")->send_keys("password1");
        $this->get_element("name=submit")->click();

        $this->get_element("signed-in")->assert_text("Currently signed in as a company");

        $this->get_element("link=View My Facilities")->click();
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
        $this->get_element("name=email")->send_keys("bigcompany1@gmail.com");
        $this->get_element("name=password")->send_keys("password1");
        $this->get_element("name=submit")->click();
        $this->get_element("link=View My Facilities")->click();
        $this->get_element("link=Create a new facility")->click();

        $this->get_element("name=address")->send_keys("1091 Huntington Rd Carol Stream Il 60082");
        $this->get_element("name=phone_number")->send_keys("8472728096");
        $this->get_element("name=submit")->click();

        $page = $this->driver->get_source();

        //assert that the single facility page is shown
        $this->assertContains("Address: 1091 Huntington Rd Carol Stream Il 60082", $page);
        $this->assertContains("Phone: 8472728096", $page);

        //assert that the new facility is shown in the facilities list
        $this->get_element("link=View all facilities")->click();
        $page = $this->driver->get_source();

        $this->assertContains("1091 Huntington Rd Carol Stream Il 60082", $page);

    }

    public function testViewManagers() {
        $this->get_element("name=email")->send_keys("bigcompany1@gmail.com");
        $this->get_element("name=password")->send_keys("password1");
        $this->get_element("name=submit")->click();

        $this->get_element("signed-in")->assert_text("Currently signed in as a company");

        $this->get_element("link=View My Managers")->click();
        $page = $this->driver->get_source();
        $this->assertContains("Created Managers", $page);
        $this->assertContains("Bob Dude", $page);
        $this->assertContains("Rick Grimes", $page);
        $this->assertContains("1", $page);
        $this->assertContains("2", $page);
    }

    public function testCreateNewManager() {
        $this->get_element("name=email")->send_keys("bigcompany1@gmail.com");
        $this->get_element("name=password")->send_keys("password1");
        $this->get_element("name=submit")->click();
        $this->get_element("link=View My Managers")->click();
        $this->get_element("link=Create A New Manager")->click();

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
        $this->get_element("name=email")->send_keys("bigcompany1@gmail.com");
        $this->get_element("name=password")->send_keys("password1");
        $this->get_element("name=submit")->click();
        $this->get_element("link=View My Managers")->click();
        $this->get_element("link=Create A New Manager")->click();

        $this->get_element("name=name")->send_keys("Test Man");
        $this->get_element("name=facility_id")->send_keys("123");
        $this->get_element("name=email")->send_keys("test@mail.com");
        $this->get_element("name=password")->send_keys("password1");
        $this->get_element("name=submit")->click();

        $page = $this->driver->get_source();

        //assert that the single facility page is shown
        $this->assertContains("Invalid information", $page);
    }

    public function tearDown(){
        parent::tearDown();
    }
}