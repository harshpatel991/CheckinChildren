<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 2/17/15
 * Time: 4:27 AM
 */
require_once dirname(__FILE__).'/../SeleniumTestBase.php';
require_once dirname(__FILE__).'/../TestMacros.php';

class LoginTest extends SeleniumTestBase
{
    public function setUp(){
        //Any additional setup goes here.
        parent::setUp();
    }

    public function test() {
        //I am redirected to login page
        $this->assert_title("Login");

        //Failed login
        testMacros::login($this->driver, "bigcompany1@gmail.com", "passwordwrong");
        $this->assert_title("Login");

        //Successful Login
        testMacros::login($this->driver, "bigcompany1@gmail.com", "password1");
        $this->assert_title("CheckinChildren");

        //Logout
        $this->get_element("name=submit")->click();
        $this->assert_title("Login");
    }

    public function tearDown(){
        //Any additional teardown goes here.
        parent::tearDown();
    }
}