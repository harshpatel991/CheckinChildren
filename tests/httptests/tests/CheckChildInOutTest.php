<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/4/15
 * Time: 10:36 PM
 */

require_once dirname(__FILE__).'/../SeleniumTestBase.php';

class CheckChildInOutTest extends SeleniumTestBase{

    public function setUp(){
        parent::setUp();
    }

    public function testCheckChildIn(){
        $this->get_element("name=email")->send_keys("employee17@gmail.com");
        $this->get_element("name=password")->send_keys("password17");
        $this->get_element("name=submit")->click();

        $this->get_element("id=checkin_children")->click();

        $this->get_element("id=ci-0")->click();
        $this->get_element("id=co-0")->click();
        $this->get_element("id=Submit")->click();

        $this->get_element("id=#modal-submit")->click();

        #make sure the subjects switched lists!

        $notHereAccordion=$this->get_element("id=nothere-accordion")->get_text();
        $hereAccordion=$this->get_element("id=here-accordion")->get_text();

        $this->assertContains("Late Parent1", $notHereAccordion);
        $this->assertContains("Child Missing1", $hereAccordion);


    }

}