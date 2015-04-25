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
        $this->assertContains("Invalid Name", $page);
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
        $this->assertContains("Invalid Name", $page);
    }

    public function testEmployeeEditProfileLongEmail() {
        testMacros::login($this->driver, "baba_ganush2@gmail.com", "password2");

        $this->get_element("id=edit_employee")->click();

        $this->get_element("id=employee_name")->clear(); //clear text input box
        $this->get_element("id=employee_name")->send_keys("Name");

        $this->get_element("id=email")->clear();
        $this->get_element("id=email")->send_keys("pHawthornpHawthornpHawthornpHawthornpHawthornpHawthornpHawthornpHawthornpHawthorn@gmail.com");

        $this->get_element("name=submit")->click();

        //Should still be old values
        $page = $this->driver->get_source();
        $this->assertContains("Matt Wallick", $page);
        $this->assertContains("baba_ganush2@gmail.com", $page);
        $this->assertContains("Invalid Email", $page);

    }

    public function testEmployeeEditProfileNoEmail() {
        testMacros::login($this->driver, "baba_ganush2@gmail.com", "password2");

        $this->get_element("id=edit_employee")->click();

        $this->get_element("id=employee_name")->clear(); //clear text input box
        $this->get_element("id=employee_name")->send_keys("Name");

        $this->get_element("id=email")->clear();
        $this->get_element("id=email")->send_keys("");

        $this->get_element("name=submit")->click();

        //Should still be old values
        $page = $this->driver->get_source();
        $this->assertContains("Matt Wallick", $page);
        $this->assertContains("baba_ganush2@gmail.com", $page);
        $this->assertContains("Invalid Email", $page);
    }

    public function testEmployeeEditPhoneInvalid() {
        testMacros::login($this->driver, "baba_ganush2@gmail.com", "password2");

        $this->get_element("id=edit_employee")->click();

        $this->get_element("id=phone_number")->clear(); //clear text input box
        $this->get_element("id=phone_number")->send_keys("123");

        $this->get_element("id=address")->clear();
        $this->get_element("id=address")->send_keys("123 fake street");

        $this->get_element("name=submit")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Invalid Phone Number (must be 10 digits)", $page);
    }

    public function testEmployeeEditPhoneValid() {
        testMacros::login($this->driver, "baba_ganush2@gmail.com", "password2");

        $this->get_element("id=edit_employee")->click();

        $this->get_element("id=phone_number")->clear(); //clear text input box
        $this->get_element("id=phone_number")->send_keys("0123456789");

        $this->get_element("id=address")->clear();
        $this->get_element("id=address")->send_keys("123 fake street");

        $this->get_element("name=submit")->click();

        $this->get_element("id=edit_employee")->click();

        $page = $this->driver->get_source();
        $this->assertContains("0123456789", $page);
        $this->assertContains("123 fake street", $page);
    }

    public function testEmployeeEditAddressInValid() {
        testMacros::login($this->driver, "baba_ganush2@gmail.com", "password2");

        $this->get_element("id=edit_employee")->click();

        $this->get_element("id=phone_number")->clear(); //clear text input box
        $this->get_element("id=phone_number")->send_keys("0123456789");

        $this->get_element("id=address")->clear();
        $this->get_element("id=address")->send_keys("123 fake street123 fake street123 fake street123 fake street123 fake street123 fake street123 fake street123 fake street123 fake street123 fake street123 fake street123 fake street");

        $this->get_element("name=submit")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Invalid Address", $page);
    }

    public function tearDown(){
        //Any additional teardown goes here.
        parent::tearDown();
    }
}