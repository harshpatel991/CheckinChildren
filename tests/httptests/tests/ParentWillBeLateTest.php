<?php
/**
 * This class tests the functionality of when the parent says they will be late.
 * Created by PhpStorm.
 * User: alex
 * Date: 4/20/15
 * Time: 6:32 PM
 */
require_once dirname(__FILE__).'/../SeleniumTestBase.php';
require_once dirname(__FILE__).'/../TestMacros.php';

class ParentWillBeLateTest extends SeleniumTestBase {

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown(){
        parent::tearDown();
    }

    public function testIWillBeLate(){
        //Login first
        testMacros::login($this->driver, "employee17@gmail.com", "password17");

        $this->get_element("name=view_children")->click();
        $this->driver->get_element("link=Late Parent1")->click();
        $this->get_element("id=here-collapse-0")->assert_text_contains("PARENT LATE: Expected at 02:40 pm");

        //log out
        $this->get_element("name=profile")->click();
        $this->get_element("name=logout")->click(); //click logout

        //Now say that the child "Parent 1" is going to be an hour (60 minutes) late
        testMacros::login($this->driver, "parent19@gmail.com", "password19");
        $this->driver->get_element("id=view_my_children")->click();
        $this->driver->get_element("link=Late Parent1")->click();
        $this->driver->get_element("id=minutes")->select_value("60");
        $this->driver->get_element("name=submit")->click();

        //log out
        $this->get_element("name=profile")->click();
        $this->get_element("name=logout")->click(); //click logout

        //Login first
        testMacros::login($this->driver, "employee17@gmail.com", "password17");

        $this->get_element("name=view_children")->click();
        $this->driver->get_element("link=Late Parent1")->click();
        $this->get_element("id=here-collapse-3")->assert_text_contains("Parent due at 03:40 pm"); //an hour later!

    }
}