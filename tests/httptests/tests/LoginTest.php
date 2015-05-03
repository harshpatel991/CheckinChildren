<?php

require_once dirname(__FILE__).'/../SeleniumTestBase.php';
require_once dirname(__FILE__).'/../TestMacros.php';

class LoginTest extends SeleniumTestBase
{
    public function setUp(){
        //Any additional setup goes here.
        parent::setUp();
    }

    public function testLogin() {
        //I am redirected to login page
        $this->assert_title("Login");

        //Failed login
        testMacros::login($this->driver, "bigcompany1@gmail.com", "passwordwrong");
        $this->assert_title("Login");

        //Successful Login
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");
        $this->assert_title("CheckinChildren");

        //Logout
        $this->get_element("name=profile")->click();
        $this->get_element("name=logout")->click();
    }

    public function tearDown(){
        //Any additional teardown goes here.
        parent::tearDown();
    }
}