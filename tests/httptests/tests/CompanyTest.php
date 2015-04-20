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
    public function testViewProfile() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("signed-in")->assert_text("Currently signed in as a company");

        $this->get_element("name=view_company_profile")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Company 1", $page);
        $this->assertContains("1 Fake St.", $page);
        $this->assertContains("Champaign IL 61820", $page);
        $this->assertContains("bigcompany1@gmail.com", $page);
        $this->assertContains("8471234567", $page);
    }
    public function testEditProfile() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("signed-in")->assert_text("Currently signed in as a company");

        $this->get_element("name=view_company_profile")->click();

        $this->get_element("id=edit_company")->click();

        $this->get_element("id=company_name")->clear();
        $this->get_element("id=company_name")->send_keys("Name Change");
        $this->get_element("id=email")->clear();
        $this->get_element("id=email")->send_keys("email@change.com");
        $this->get_element("id=address")->clear();
        $this->get_element("id=address")->send_keys("Change Address");
        $this->get_element("id=phone_number")->clear();
        $this->get_element("id=phone_number")->send_keys("7651237890");
        $this->get_element("name=submit")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Name Change", $page);
        $this->assertContains("email@change.com", $page);
        $this->assertContains("Change Address", $page);
        $this->assertContains("7651237890", $page);
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
    public function testEditFacility() {
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

        $this->get_element("name=edit_facility")->click();
        $this->get_element("id=address")->clear();
        $this->get_element("id=address")->send_keys("22 EditFacility Rd. Champaign IL 61820");

        $this->get_element("id=phone")->clear();
        $this->get_element("id=phone")->send_keys("1231237890");
        $this->get_element("name=submit")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Facility ID: 2", $page);
        $this->assertContains("Company ID: 1", $page);
        $this->assertContains("Address: 22 EditFacility Rd. Champaign IL 61820", $page);
        $this->assertContains("Phone: 1231237890", $page);
    }

    public function testEditFacilityInvalid() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("signed-in")->assert_text("Currently signed in as a company");

        $this->get_element("name=view_facilities")->click();
        $page = $this->driver->get_source();
        $this->assertContains("My Facilities", $page);
        $this->assertContains("1 Facility Rd. Champaign IL 61820", $page);

        $this->get_element("link=1 Facility Rd. Champaign IL 61820")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Facility ID: 1", $page);
        $this->assertContains("Company ID: 1", $page);
        $this->assertContains("Address: 1 Facility Rd. Champaign IL 61820", $page);
        $this->assertContains("Phone: 1235933945", $page);

        $this->get_element("name=edit_facility")->click();


        $this->get_element("id=address")->clear();
        $this->get_element("name=submit")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Invalid Address", $page);

        $this->get_element("id=phone")->clear();
        $this->get_element("name=submit")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Invalid Phone Number", $page);

        $this->get_element("id=phone")->clear();
        $this->get_element("id=phone")->send_keys("1231237890565");
        $this->get_element("name=submit")->click();
        $page = $this->driver->get_source();
        $this->assertContains("Invalid Phone Number", $page);
    }

    public function testDeleteFacility() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("signed-in")->assert_text("Currently signed in as a company");

        $this->get_element("name=view_facilities")->click();
        $page = $this->driver->get_source();
        $this->assertContains("My Facilities", $page);
        $this->assertContains("1 Facility Rd. Champaign IL 61820", $page);

        $this->get_element("link=1 Facility Rd. Champaign IL 61820")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Facility ID: 1", $page);
        $this->assertContains("Company ID: 1", $page);
        $this->assertContains("My Facilities", $page);
        $this->assertNOtContains("1 Facility Rd. Champaign IL 61820", $page);

    }

    public function testViewManagers() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("signed-in")->assert_text("Currently signed in as a company");

        $this->get_element("name=view_managers")->click();
        $this->assertContains("Address: 1 Facility Rd. Champaign IL 61820", $page);
        $this->assertContains("Phone: 1235933945", $page);

        $this->get_element("id=delete_facility")->click();

        $this->get_element("id=modal-submit")->click();
        $page = $this->driver->get_source();
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

        //assert that the single facility page is shown
        $error_msg = $this->get_element("id=error_message")->get_text();
        $this->assertContains("Facility not found", $error_msg);


    }

    public function testCreateNewFacilityInvalid() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("name=view_facilities")->click();
        $this->get_element("name=new_facility")->click();

        $this->get_element("name=address")->send_keys("");
        $this->get_element("name=phone_number")->send_keys("8472728096");
        $this->get_element("name=submit")->click();


        $error_msg = $this->get_element("id=error_message")->get_text();
        $this->assertContains("Invalid Address", $error_msg);

    }

    public function testDemoteManager() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("name=view_managers")->click();
        $this->get_element("link=Bob Dude")->click();
        $this->get_element("link=Demote Manager")->click();

        $page = $this->driver->get_source();

        //assert that the single facility page is shown
        $this->assertContains('<td id="emp_status">employee</td>', $page);
    }

    public function testDemoteManagerNotFound() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("name=view_managers")->click();
        $this->get_element("link=Bob Dude")->click();
        $this->get_element("link=Demote Manager")->click();
        $this->get_element("link=View My Managers")->click();

        $page = $this->driver->get_source();

        //assert that the single facility page is shown
        $this->assertNotContains('Bob Dude', $page);
    }

    public function testDemoteManagerFromFacility() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("name=view_facilities")->click();
        $this->get_element("link=1 Facility Rd. Champaign IL 61820")->click();
        $this->get_element("link=View all employees")->click();
        $this->get_element("link=Bob Dude")->click();
        $this->get_element("link=Demote Manager")->click();
        $this->get_element("link=View My Managers")->click();

        $page = $this->driver->get_source();

        //assert that the single facility page is shown
        $this->assertNotContains('Bob Dude', $page);
    }

    public function testCreateNewManagerAndDemote() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("name=view_managers")->click();
        $this->get_element("name=create_manager")->click();

        $this->get_element("name=name")->send_keys("Test Man");
        $this->get_element("name=facility_id")->send_keys("1");
        $this->get_element("name=email")->send_keys("test@mail.com");
        $this->get_element("name=password")->send_keys("password1");
        $this->get_element("name=submit")->click();

        $this->get_element("name=view_managers")->click();
        $this->get_element("link=Test Man")->click();
        $this->get_element("link=Demote Manager")->click();
        $this->get_element("link=View My Managers")->click();

        $page = $this->driver->get_source();

        //assert that the single facility page is shown
        $this->assertNotContains('Test Man', $page);
    }

    public function testCreateNewManagerAndDemoteInFacility() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("name=view_managers")->click();
        $this->get_element("name=create_manager")->click();

        $this->get_element("name=name")->send_keys("Test Man");
        $this->get_element("name=facility_id")->send_keys("1");
        $this->get_element("name=email")->send_keys("test@mail.com");
        $this->get_element("name=password")->send_keys("password1");
        $this->get_element("name=submit")->click();

        $this->get_element("name=view_facilities")->click();
        $this->get_element("link=1 Facility Rd. Champaign IL 61820")->click();
        $this->get_element("link=View all employees")->click();
        $this->get_element("link=Test Man")->click();
        $this->get_element("link=Demote Manager")->click();
        $this->get_element("link=View My Managers")->click();

        $page = $this->driver->get_source();

        //assert that the single facility page is shown
        $this->assertNotContains('Test Man', $page);
    }


    public function testDeleteManager() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("name=view_managers")->click();
        $this->get_element("link=Bob Dude")->click();
        $this->get_element("link=Delete Employee")->click();

        $this->get_element("name=view_managers")->click();

        $page = $this->driver->get_source();

        //assert that the single facility page is shown
        $this->assertNotContains('Bob Dude', $page);
    }

    public function testDeleteManagerFromFacility() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("name=view_facilities")->click();
        $this->get_element("link=1 Facility Rd. Champaign IL 61820")->click();
        $this->get_element("link=View all employees")->click();
        $this->get_element("link=Bob Dude")->click();
        $this->get_element("link=Delete Employee")->click();
        $this->get_element("link=View My Managers")->click();

        $page = $this->driver->get_source();

        //assert that the single facility page is shown
        $this->assertNotContains('Bob Dude', $page);
    }

    public function testCreateNewManagerAndDelete() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("name=view_managers")->click();
        $this->get_element("name=create_manager")->click();

        $this->get_element("name=name")->send_keys("Test Man");
        $this->get_element("name=facility_id")->send_keys("1");
        $this->get_element("name=email")->send_keys("test@mail.com");
        $this->get_element("name=password")->send_keys("password1");
        $this->get_element("name=submit")->click();

        $this->get_element("name=view_managers")->click();
        $this->get_element("link=Test Man")->click();
        $this->get_element("link=Delete Employee")->click();

        $this->get_element("name=profile")->click();
        $this->get_element("name=logout")->click();

        testMacros::login($this->driver, "test@mail.com", "password1");


        $page = $this->driver->get_source();

        //assert that the single facility page is shown
        $this->assertNotContains('Currently signed in as', $page);
    }

    public function testViewFacilityEmployees() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("name=view_facilities")->click();
        $this->get_element("link=1 Facility Rd. Champaign IL 61820")->click();
        $this->get_element("link=View all employees")->click();

        $page = $this->driver->get_source();

        //assert that the single facility page is shown
        $this->assertContains('Bob Dude', $page);
        $this->assertContains('Matt Wallick', $page);
    }

    public function testCreateNewManagerAndViewFacilityEmployees() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("name=view_managers")->click();
        $this->get_element("name=create_manager")->click();

        $this->get_element("name=name")->send_keys("Test Man");
        $this->get_element("name=facility_id")->send_keys("1");
        $this->get_element("name=email")->send_keys("test@mail.com");
        $this->get_element("name=password")->send_keys("password1");
        $this->get_element("name=submit")->click();

        $this->get_element("name=view_facilities")->click();
        $this->get_element("link=1 Facility Rd. Champaign IL 61820")->click();
        $this->get_element("link=View all employees")->click();

        $page = $this->driver->get_source();

        //assert that the single facility page is shown
        $this->assertContains('Test Man', $page);
    }

    public function testDeleteManagerAndViewFacility() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("name=view_managers")->click();
        $this->get_element("link=Bob Dude")->click();
        $this->get_element("link=Delete Employee")->click();

        $this->get_element("name=view_facilities")->click();
        $this->get_element("link=1 Facility Rd. Champaign IL 61820")->click();
        $this->get_element("link=View all employees")->click();

        $page = $this->driver->get_source();

        //assert that the single facility page is shown
        $this->assertNotContains('Bob Dude', $page);
    }
    public function testMoveEmployee() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("name=view_facilities")->click();
        $this->get_element("link=1 Facility Rd. Champaign IL 61820")->click();
        $this->get_element("link=View all employees")->click();
        $page = $this->driver->get_source();

        $this->assertContains('Bob Dude', $page);
        $this->get_element("link=Bob Dude")->click();
        $this->get_element("id=move_employee")->click();
        $this->get_element("name=facility_id")->select_option("2 Facility Rd. Champaign IL 61820");
        $this->get_element("name=move_modal_submit")->click();

        $this->get_element("name=view_facilities")->click();
        $this->get_element("link=1 Facility Rd. Champaign IL 61820")->click();
        $this->get_element("link=View all employees")->click();
        $page = $this->driver->get_source();
        $this->assertNotContains('Bob Dude', $page);

        $this->get_element("name=view_facilities")->click();
        $this->get_element("link=2 Facility Rd. Champaign IL 61820")->click();
        $this->get_element("link=View all employees")->click();
        $page = $this->driver->get_source();
        $this->assertContains('Bob Dude', $page);
    }
    public function testMoveChild() {
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");

        $this->get_element("name=view_facilities")->click();
        $this->get_element("link=1 Facility Rd. Champaign IL 61820")->click();
        $this->get_element("link=View all Children")->click();
        $page = $this->driver->get_source();

        $this->assertContains('Mark Zuckerberg', $page);
        $this->get_element("link=Mark Zuckerberg")->click();
        $this->get_element("id=move_child")->click();
        $this->get_element("name=facility_id")->select_option("2 Facility Rd. Champaign IL 61820");
        $this->get_element("name=move_modal_submit")->click();

        $this->get_element("name=view_facilities")->click();
        $this->get_element("link=1 Facility Rd. Champaign IL 61820")->click();
        $this->get_element("link=View all Children")->click();
        $page = $this->driver->get_source();
        $this->assertNotContains('Mark Zuckerberg', $page);

        $this->get_element("name=view_facilities")->click();
        $this->get_element("link=2 Facility Rd. Champaign IL 61820")->click();
        $this->get_element("link=View all Children")->click();
        $page = $this->driver->get_source();
        $this->assertContains('Mark Zuckerberg', $page);
    }
    public function tearDown(){
        parent::tearDown();
    }
}