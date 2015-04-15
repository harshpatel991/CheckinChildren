<?php
// This class doesn't quite work correctly yet, so leave in until we figure out
// how to generate a 'malicious' POST request with Selenium Server running


require_once dirname(__FILE__).'/../SeleniumTestBase.php';
require_once dirname(__FILE__).'/../TestMacros.php';
require_once dirname(__FILE__).'/../../../scripts/cookieManager.php';

class PermissionsTest extends SeleniumTestBase{

    public function setUp(){
        parent::setUp();
    }

    /**
     * @dataProvider dataProviderInvalidPageVisits
     */
    public function testInvalidPagePermissions($page, $userName, $password){
        testMacros::login($this->driver, $userName, $password);
        $this->gotoPage($page);
        $this->driver->assert_title("CheckinChildren");
        $this->driver->get_element('id=error_message')->assert_text_contains('Permissions Error');
    }

    public function dataProviderInvalidPageVisits(){
        return array(
            array('checkinChildren.php', 'bigcompany1@gmail.com', 'password1'),
            array('checkinChildren.php', 'parent19@gmail.com', 'password19'),
            array('createChild.php', 'bigcompany1@gmail.com', 'password1'),
            array('createChild.php', 'parent19@gmail.com', 'password19'),
            array('createEmployee.php', 'parent19@gmail.com', 'password19'),
            array('createEmployee.php', 'employee17@gmail.com', 'password17'),
            array('createFacility.php', 'parent19@gmail.com', 'password19'),
            array('createFacility.php', 'employee17@gmail.com', 'password17'),
            array('displayEmployees.php', 'parent19@gmail.com', 'password19'),
            array('displayEmployees.php', 'employee17@gmail.com', 'password17'),
            array('displayFacilities.php', 'parent19@gmail.com', 'password19'),
            array('displayFacilities.php', 'employee17@gmail.com', 'password17'),
            array('displayParentInfo.php', 'employee17@gmail.com', 'password17'),
            array('displayParentInfo.php', 'manager6@gmail.com', 'password6'),
        );
    }

    public function testViewWrongChild(){
        testMacros::login($this->driver, 'parent19@gmail.com', 'password19');
        $this->driver->get_element("id=view_my_children")->click();
        $this->driver->get_element("link=Ludvig Beethoven")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Ludvig Beethoven", $page);
        $this->assertContains("4", $page);
        $this->assertContains("Dogs", $page);

        $this->gotoPage('displayChild.php?child_id=2');
        $this->driver->get_element('id=error_message')->assert_text_contains('Invalid Child');
    }

    public function testViewWrongEmployee(){
        testMacros::login($this->driver, 'bigcompany1@gmail.com', 'password1');
        $this->driver->get_element('name=view_managers')->click();
        $this->driver->get_element('link=Bob Dude')->click();
        $pageSource = $this->driver->get_source();
        $this->assertContains('manager6@gmail.com', $pageSource);
        $this->gotoPage('displayEmployee.php?employee_id=15');
        $this->driver->get_element('id=error_message')->assert_text_contains('Invalid Employee');
    }

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

}