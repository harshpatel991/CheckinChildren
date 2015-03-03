<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 2/17/15
 * Time: 4:27 AM
 */
require_once dirname(__FILE__).'/../SeleniumTestBase.php';
require_once dirname(__FILE__).'/../TestMacros.php';

class UpdatePasswordTest extends SeleniumTestBase
{
    public function setUp(){
        //Any additional setup goes here.
        parent::setUp();
    }

    public function testParent() {
        //I am redirected to login page
        $this->assert_title("Login");


        //Login
        testMacros::login($this->driver, "parent19@gmail.com", "password19");
        $this->assert_title("CheckinChildren");
        //Click View Profile
        $this->get_element("id=view_parent_info")->click();
        //Click Update Password
        $this->get_element("id=update_password")->click();
        $this->get_element("name=)


    }

    public function tearDown(){
        //Any additional teardown goes here.
        parent::tearDown();
    }
}