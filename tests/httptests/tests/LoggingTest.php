<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 4/4/15
 * Time: 12:16 AM
 */

require_once dirname(__FILE__).'/../SeleniumTestBase.php';
require_once dirname(__FILE__).'/../TestMacros.php';

class LoggingTest extends SeleniumTestBase {

    public function setUp(){
        parent::setUp();
    }

    public function testCreateChildLog(){

        testMacros::login($this->driver, "manager6@gmail.com", "password6");

        $this->get_element("name=create_child")->click();

        $this->get_element("name=name")->send_keys("Test Case1");
        $this->get_element("name=PID")->select2("Big Daddy (parent8@gmail.com)");
        $this->get_element("name=aller")->send_keys("many");
        $this->get_element("name=submit")->click();

        $this->get_element("name=display_logs")->click();

        $page=$this->driver->get_source();

        $this->assertContains("Test Case1", $page);
        $this->assertContains("Child Created", $page);
    }

    public function testCreateParentLog(){

    }

    public function testCreateEmployeeLog(){

    }

    public function testEditEmployeeLog(){

    }

    public function testPromoteEmployeeLog(){

    }

    public function testCheckInCheckOutLog(){

    }

    public function tearDown()
    {
        //Any additional teardown goes here.
        parent::tearDown();
    }
}