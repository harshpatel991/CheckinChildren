<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 2/17/15
 * Time: 4:27 AM
 */
require_once '../SeleniumTestBase.php';

class LoginTest extends SeleniumTestBase
{
    public function setUp(){
        //Any additional setup goes here.
        parent::setUp();
    }

    public function test() {
        $this->get_element("name=email")->send_keys("bigcompany1@gmail.com");
        $this->get_element("name=password")->send_keys("password1");
        $this->get_element("name=submit")->click();
        //TODO: Finish this test case.
    }

    public function tearDown(){
        //Any additional teardown goes here.
        parent::tearDown();
    }
}