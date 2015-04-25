<?php

require_once dirname(__FILE__).'/../SeleniumTestBase.php';
require_once dirname(__FILE__).'/../TestMacros.php';

class CheckChildInOutTest extends SeleniumTestBase{

    public function setUp(){
        parent::setUp();
    }

    public function testCheckChildIn(){

        testMacros::login($this->driver, "employee17@gmail.com", "password17");

        $this->driver->get_element("name=view_children")->click();

        $this->driver->get_element("id=ci-0")->click();
        $this->driver->get_element("id=co-0")->click();
        $this->driver->get_element("id=saveButton")->click();

        $this->driver->get_all_elements("name=checkinActor[]")[0]->send_keys('Test Guardian1');
        $this->driver->get_all_elements("name=checkoutActor[]")[0]->send_keys('Test Guardian2');

        $this->driver->get_element("id=modal-submit")->clickByJs();

        #make sure the subjects switched lists!

        $notHereAccordion=$this->driver->get_element("id=nothere-accordion")->get_text();
        $hereAccordion=$this->driver->get_element("id=here-accordion")->get_text();

        $this->assertContains("Late Parent1", $notHereAccordion);
        $this->assertContains("Child Missing1", $hereAccordion);
    }

}