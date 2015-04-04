<?php
require_once dirname(__FILE__).'/../SeleniumTestBase.php';
require_once dirname(__FILE__).'/../TestMacros.php';

class EmployeeTest extends SeleniumTestBase {

    public function setUp(){
        //Any additional setup goes here.
        parent::setUp();
    }

    public function testEmployeeLogin() {
        testMacros::login($this->driver, "baba_ganush2@gmail.com", "password2");

        $this->get_element("id=signed-in")->assert_text("Currently signed in as a employee");
    }

    public function testEmployeeEditProfile() {
        testMacros::login($this->driver, "baba_ganush2@gmail.com", "password2");

        $this->get_element("id=edit_employee")->click();

        $this->get_element("id=employee_name")->clear(); //clear text input box
        $this->get_element("id=employee_name")->send_keys("Pierce Hawthorn");

        $this->get_element("id=email")->clear();
        $this->get_element("id=email")->send_keys("pHawthorn@gmail.com");

        $this->get_element("name=submit")->click();
        $this->get_element("id=edit_employee")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Pierce Hawthorn", $page);
        $this->assertContains("pHawthorn@gmail.com", $page);

    }

    public function testEmployeeEditProfileLongName() {
        testMacros::login($this->driver, "baba_ganush2@gmail.com", "password2");

        $this->get_element("id=edit_employee")->click();

        $this->get_element("id=employee_name")->clear(); //clear text input box
        $this->get_element("id=employee_name")->send_keys("Pierce Hawthorn Pierce Hawthorn Pierce Hawthorn Pierce Hawthorn Pierce Hawthorn");

        $this->get_element("id=email")->clear();
        $this->get_element("id=email")->send_keys("pHawthorn@gmail.com");

        $this->get_element("name=submit")->click();

        //Should still be old values
        $page = $this->driver->get_source();
        $this->assertContains("Matt Wallick", $page);
        $this->assertContains("baba_ganush2@gmail.com", $page);
    }

    public function testEmployeeEditProfileNoName() {
        testMacros::login($this->driver, "baba_ganush2@gmail.com", "password2");

        $this->get_element("id=edit_employee")->click();

        $this->get_element("id=employee_name")->clear(); //clear text input box
        $this->get_element("id=employee_name")->send_keys("");

        $this->get_element("id=email")->clear();
        $this->get_element("id=email")->send_keys("pHawthorn@gmail.com");

        $this->get_element("name=submit")->click();

        //Should still be old values
        $page = $this->driver->get_source();
        $this->assertContains("Matt Wallick", $page);
        $this->assertContains("baba_ganush2@gmail.com", $page);
    }

    public function testEmployeeEditProfileLongEmail() {
        testMacros::login($this->driver, "baba_ganush2@gmail.com", "password2");

        $this->get_element("id=edit_employee")->click();

        $this->get_element("id=employee_name")->clear(); //clear text input box
        $this->get_element("id=employee_name")->send_keys("");

        $this->get_element("id=email")->clear();
        $this->get_element("id=email")->send_keys("pHawthornpHawthornpHawthornpHawthornpHawthornpHawthornpHawthornpHawthornpHawthorn@gmail.com");

        $this->get_element("name=submit")->click();

        //Should still be old values
        $page = $this->driver->get_source();
        $this->assertContains("Matt Wallick", $page);
        $this->assertContains("baba_ganush2@gmail.com", $page);

    }

    public function testEmployeeEditProfileNoEmail() {
        testMacros::login($this->driver, "baba_ganush2@gmail.com", "password2");

        $this->get_element("id=edit_employee")->click();

        $this->get_element("id=employee_name")->clear(); //clear text input box
        $this->get_element("id=employee_name")->send_keys("");

        $this->get_element("id=email")->clear();
        $this->get_element("id=email")->send_keys("");

        $this->get_element("name=submit")->click();

        //Should still be old values
        $page = $this->driver->get_source();
        $this->assertContains("Matt Wallick", $page);
        $this->assertContains("baba_ganush2@gmail.com", $page);
    }


    public function tearDown(){
        //Any additional teardown goes here.
        parent::tearDown();
    }
}