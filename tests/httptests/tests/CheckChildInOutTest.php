<?php

require_once dirname(__FILE__).'/../SeleniumTestBase.php';
require_once dirname(__FILE__).'/../TestMacros.php';

class CheckChildInOutTest extends SeleniumTestBase{

    public function setUp(){
        parent::setUp();
    }

    public function testCheckChildIn(){

        testMacros::login($this->driver, "employee17@gmail.com", "password17");

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