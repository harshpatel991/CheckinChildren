<?php

require_once(dirname(__FILE__).'/../../scripts/controllers/authController.php');
require_once(dirname(__FILE__).'/../../scripts/cookieManager.php');
require_once(dirname(__FILE__).'/../../scripts/models/userModel.php');
require_once(dirname(__FILE__).'/../../scripts/models/dao/userDAO.php');
require_once(dirname(__FILE__).'/UnitTestBase.php');

/**
 * Class authControllerTest
 *
 * Tests the authController class
 */
class authControllerTest extends unitTestBase
{
    private $mockCookieManager;
    private $mockCookies;

    public function setUp(){
        $_SERVER['HTTP_USER_AGENT'] = 'fakeuser';
        $this->mockCookies = array();

        // Setup mock objects to mimick the use of browser cookies for authentication
        $this->mockCookieManager = $this->getMock('cookieManager', array('getCookies', 'setCookie', 'clearAuthCookies'));

        $this->mockCookieManager->expects($this->any())->method('getCookies')->will($this->returnCallback(
            function(){
                return $this->mockCookies;
            }
        ));

        $this->mockCookieManager->expects($this->any())->method('setCookie')->will($this->returnCallback(
            function($name, $value, $expire, $domain){
                $this->mockCookies[$name] = $value;
            }
        ));

        $this->mockCookieManager->expects($this->any())->method('clearAuthCookies')->will($this->returnCallback(
            function(){
                $this->mockCookies[cookieManager::$authToken] = '';
                $this->mockCookies[cookieManager::$userId] = '';
                $this->mockCookies[cookieManager::$userRole] = '';
            }
        ));

        parent::setUp();
    }

    /**
     * @dataProvider loginTestDataProvider
     */
    public function testValidLogin($id, $role)
    {
        $this->mockCookieManager->expects($this->exactly(0))->method('clearAuthCookies');
        $this->loginAsUser($id);
        $authController = new authController($this->mockCookieManager);
        $this->assertEquals($authController->authStatus, authStatus::valid);
        $this->assertTrue($authController->verifyRole([$role]));
        $this->assertEquals($authController->authStatus, authStatus::valid);
    }

    public function loginTestDataProvider(){
        return array(
            array(1, 'company'),
            array(6, 'manager'),
            array(2, 'employee'),
            array(8, 'parent'),
        );
    }

    public function testNotLoggedIn()
    {
        $this->mockCookieManager->expects($this->exactly(1))->method('clearAuthCookies');
        $authController = new authController($this->mockCookieManager);
        $this->assertEquals($authController->authStatus, authStatus::not_logged_in);
    }

    /**
     * @dataProvider invalidLoginTestDataProvider
     */
    public function testInvalidLogin($id, $role)
    {
        $this->mockCookieManager->expects($this->exactly(1))->method('clearAuthCookies');
        $this->loginAsUser($id);
        $this->mockCookieManager->setCookie(cookieManager::$authToken, 'fake_auth_token', '', '');
        $authController = new authController($this->mockCookieManager);
        $this->assertEquals($authController->authStatus, authStatus::invalid_identity);
        $this->assertFalse($authController->verifyRole([$role]));
        $this->assertFalse($authController->verifyChildPermissions(1));
        $this->assertFalse($authController->verifyEmployeePermissions(1));
        $this->assertFalse($authController->verifyFacilityPermissions(1));
    }

    public function invalidLoginTestDataProvider(){
        return array(
            array(1, 'manager'),
            array(6, 'employee'),
            array(2, 'parent'),
            array(8, 'company'),
        );
    }

    /**
     * @dataProvider invalidRoleTestDataProvider
     */
    public function testInvalidRole($id, $role)
    {
        $this->mockCookieManager->expects($this->exactly(0))->method('clearAuthCookies');
        $this->loginAsUser($id);
        $authController = new authController($this->mockCookieManager);
        $this->assertEquals($authController->authStatus, authStatus::valid);
        $this->assertFalse($authController->verifyRole([$role]));
        $this->assertEquals($authController->authStatus, authStatus::invalid_permissions);
    }

    public function invalidRoleTestDataProvider(){
        return array(
            array(1, 'manager'),
            array(6, 'employee'),
            array(2, 'parent'),
            array(8, 'company'),
        );
    }

    /**
     * @dataProvider facilityPermissionsTestDataProvider
     */
    public function testFacilityPermissions($userId, $facilityId, $permissions)
    {
        $this->loginAsUser($userId);
        $authController = new authController($this->mockCookieManager);
        $this->assertEquals($authController->authStatus, authStatus::valid);
        $this->assertEquals($authController->verifyFacilityPermissions($facilityId), $permissions);
        $expectedStatus = $permissions ? authStatus::valid : authStatus::invalid_permissions;
        $this->assertEquals($authController->authStatus, $expectedStatus);
    }

    public function facilityPermissionsTestDataProvider(){
        return array(
            array(1, 2, true),
            array(1, 3, false),
            array(1, 10, false),
            array(2, 1, false),
        );
    }

    /**
     * @dataProvider childPermissionsTestDataProvider
     */
    public function testChildPermissions($userId, $childId, $permissions)
    {
        $this->loginAsUser($userId);
        $authController = new authController($this->mockCookieManager);
        $this->assertEquals($authController->authStatus, authStatus::valid);
        $this->assertEquals($authController->verifyChildPermissions($childId), $permissions);
        $expectedStatus = $permissions ? authStatus::valid : authStatus::invalid_permissions;
        $this->assertEquals($authController->authStatus, $expectedStatus);
    }

    public function childPermissionsTestDataProvider(){
        return array(
            array(4, 3, true),
            array(4, 2, false),
            array(6, 2, true),
            array(6, 3, false),
            array(8, 2, true),
            array(8, 1, false),
            array(8, 1, false),
            array(1, 1, false),
            array(1, 2, true),
            array(1, 999, false),
        );
    }

    /**
     * @dataProvider employeePermissionsTestDataProvider
     */
    public function testEmployeePermissions($userId, $empId, $permissions)
    {
        $this->loginAsUser($userId);
        $authController = new authController($this->mockCookieManager);
        $this->assertEquals($authController->authStatus, authStatus::valid);
        $this->assertEquals($authController->verifyEmployeePermissions($empId), $permissions);
        $expectedStatus = $permissions ? authStatus::valid : authStatus::invalid_permissions;
        $this->assertEquals($authController->authStatus, $expectedStatus);
    }

    public function employeePermissionsTestDataProvider(){
        return array(
            array(6, 2, true),
            array(6, 4, false),
            array(2, 6, false),
            array(6, 999, false),
            array(1, 6, true),
            array(6, 1, false),
            array(1, 11, false),
            array(8, 2, false),
            array(8, 4, false),
        );
    }

    private function loginAsUser($id){
        $userDao = new userDAO();
        $user = $userDao->find('id',$id);
        $user->auth_token = $user->genAuthToken();
        $userDao->updateField($id, 'auth_token', $user->auth_token);
        $this->mockCookieManager->setAuthCookies($user);
        return $user;
    }
}
