<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 2/17/15
 * Time: 4:27 AM
 */
require_once dirname(__FILE__).'/../SeleniumTestBase.php';
require_once dirname(__FILE__).'/../TestMacros.php';

class ViewParentInfoTest extends SeleniumTestBase
{
    public function setUp(){
        //Any additional setup goes here.
        parent::setUp();
    }

    public function test() {
        //I am redirected to login page
        $this->assert_title("Login");


        //Login
        testMacros::login($this->driver, "parent19@gmail.com", "password19");
        //Click View Profile
        $this->get_element("name=view_parent_profile")->click();
        $page = $this->driver->get_source();

        $this->assertContains("Momma Jamma", $page);
        $this->assertContains("456 Real Ave Urbana IL 61820", $page);
        $this->assertContains("parent19@gmail.com", $page);
        $this->assertContains("6786546789", $page);
    }

    public function tearDown(){
        //Any additional teardown goes here.
        parent::tearDown();
    }
}