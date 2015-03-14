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
        $this->get_element("name=view_parent_profile")->click();
        //Click Update Password
        $this->get_element("id=update_password")->click();

        //Bad old password
        $this->get_element("name=old_password")->send_keys("password21");
        $this->get_element("name=new_password")->send_keys("password19");
        $this->get_element("name=con_password")->send_keys("password19");
        $this->get_element("name=submit")->click();
        $page = $this->driver->get_source();
        $this->assertContains("Old Password is Incorrect", $page);
        //Bad confirm password
        $this->get_element("name=old_password")->send_keys("password19");
        $this->get_element("name=new_password")->send_keys("test19");
        $this->get_element("name=con_password")->send_keys("password19");
        $this->get_element("name=submit")->click();
        $page = $this->driver->get_source();
        $this->assertContains("New Password and Confirmation Don't Match", $page);
        //Good update password
        $this->get_element("name=old_password")->send_keys("password19");
        $this->get_element("name=new_password")->send_keys("pass19");
        $this->get_element("name=con_password")->send_keys("pass19");
        $this->get_element("name=submit")->click();

        $this->get_element("name=profile")->click();
        $this->get_element("name=logout")->click(); //click logout

        testMacros::login($this->driver, "parent19@gmail.com", "pass19");
        $page = $this->driver->get_source();
        $this->assertContains("parent", $page);

    }

    public function tearDown(){
        //Any additional teardown goes here.
        parent::tearDown();
    }
}