<?php

require_once(dirname(__FILE__).'/../../scripts/controllers/authController.php');
require_once(dirname(__FILE__).'/../../scripts/cookieManager.php');
require_once(dirname(__FILE__).'/../../scripts/models/userModel.php');
require_once(dirname(__FILE__).'/../../scripts/models/dao/userDAO.php');
require_once(dirname(__FILE__).'/UnitTestBase.php');

class authControllerTest extends unitTestBase
{
    public function setUp(){
        $_SERVER['HTTP_USER_AGENT'] = 'fakeuser';
    }

    public function testValidLoginCompany()
    {
        //Company
        $companyUser = $this->loginAsUser(1);
        $authController = new authController();
        $this->assertEquals($authController->authStatus, authStatus::valid);
    }

    private function loginAsUser($id){
        $userDao = new UserDAO();
        $user = $userDao->find('id',$id);
        $user->auth_token = $user->genAuthToken();
        $userDao->updateField(1, 'auth_token', $user->auth_token);
        cookieManager::setAuthCookies($user);
        return $user;
    }
}
