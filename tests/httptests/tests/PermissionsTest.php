<?php
// This class doesn't quite work correctly yet, so leave in until we figure out
// how to generate a 'malicious' POST request with Selenium Server running


//require_once dirname(__FILE__).'/../SeleniumTestBase.php';
//require_once dirname(__FILE__).'/../TestMacros.php';
//require_once dirname(__FILE__).'/../../../scripts/cookieManager.php';
//
//class PermissionsTest extends SeleniumTestBase{
//
//    public function setUp(){
//        parent::setUp();
//    }
//
//    public function testParentCreatesEmployee(){
//
//        testMacros::login($this->driver, "employee17@gmail.com", "password17");
//
//        $this->get_element("name=view_children")->click();
//
//        $this->get_element("id=ci-0")->click();
//        $this->get_element("id=co-0")->click();
//        $this->get_element("id=Submit")->click();
//
//        $this->get_element("id=modal-submit")->clickByJs();
//
//        #make sure the subjects switched lists!
//
//        $notHereAccordion=$this->get_element("id=nothere-accordion")->get_text();
//        $hereAccordion=$this->get_element("id=here-accordion")->get_text();
//
//        $this->assertContains("Late Parent1", $notHereAccordion);
//        $this->assertContains("Child Missing1", $hereAccordion);
//    }
//
//    public function testMaliciousPostCreateEmployee(){
//        testMacros::login($this->driver, "parent19@gmail.com", "password19");
//        $auth_token = $this->get_cookie('auth_token')['value'];
//        $user_id = $this->get_cookie('user_id')['value'];
//
//        $url = $this->rootUrl.'http://localhost:4444/CheckinChildren/scripts/controllers/form_handlers/createEmployeeFormHandler.php';
//        var_dump($url);
//        $data = array('name' => 'Evil Manager', 'email' => 'l33t@h4xor.com', 'role' => 'employee', 'submit' => 'Submit');
//
//        $options = array(
//            'http' => array(
//                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
//                'method'  => 'POST',
//                'cookies' => 'user_id='.$user_id.'; auth_token='.$auth_token.'; user_role=parent',
//                'content' => http_build_query($data)
//            ),
//        );
//        $context  = stream_context_create($options);
//        $result = file_get_contents($url, false, $context);
//        var_dump($result);
//    }
//
//}