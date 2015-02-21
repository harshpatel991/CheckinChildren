<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 2/17/15
 * Time: 4:27 AM
 */
require_once '../SeleniumTestBase.php';
require_once '../TestMacros.php';

class CreateCompanyTest extends SeleniumTestBase
{
    public function test() {
        //I am redirected to login page
        $this->assert_title("Login");

        //Go to CreateCompany page
        $this->get_element("id=createCompany")->click();
        $this->assert_title("Create a Company");

        //Create a new company
        testMacros::createCompany($this->driver, "Test Company 1", "123 Fake Dr", "1234567890", "newcompany@gmail.com", "password1");
        $this->assert_title("Login");

        //Login as new company
        testMacros::login($this->driver, "newcompany@gmail.com", "password1");
        $this->assert_title("CheckinChildren");

        //View Facilities and Managers
        $this->get_element("id=display_facilities")->click();
        $this->get_element("id=title")->assert_text("My Facilities");
        $this->get_element("id=home")->click();
        $this->get_element("id=display_managers")->click();
        $this->get_element("id=title")->assert_text("Created Managers");

    }
}