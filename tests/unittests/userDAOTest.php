<?php

require_once(dirname(__FILE__).'/../../scripts/models/dao/userDAO.php');
require_once(dirname(__FILE__).'/UnitTestBase.php');

class userDAOTest extends unitTestBase
{

    public function testFind()
    {
        $userDAO=new userDAO();

        $user=$userDAO->find("id",8);
        $this->assertEquals($user->email, "parent8@gmail.com");
        $this->assertEquals($user->password, "a8dbbfa41cec833f8dd42be4d1fa9a13142c85c2");
    }

    public function testInsert()
    {
        $userDAO=new userDAO();

        $userTest = new userModel("test@test.com","pword", "parent");
        $id = $userDAO->insert($userTest);

        $user=$userDAO->find("id",$id);

        $this->assertEquals("test@test.com", $user->email);
        $this->assertEquals("pword", $user->password);
        $this->assertEquals("parent", $user->role);
        $this->assertEquals($id, $user->id);
    }


    public function testUpdateEmailTest() {
        $userDAO = new userDAO();
        $user=$userDAO->find("id",8);
        $this->assertEquals($user->email, "parent8@gmail.com");
        $this->assertEquals($user->password, "a8dbbfa41cec833f8dd42be4d1fa9a13142c85c2");
        $userDAO->updateField(8,"email","test@test.com");
        $user=$userDAO->find("id",8);
        $this->assertEquals($user->email, "test@test.com");
        $this->assertEquals($user->password, "a8dbbfa41cec833f8dd42be4d1fa9a13142c85c2");
    }
    public function testUpdatePasswordTest() {
        $userDAO = new userDAO();
        $user=$userDAO->find("id",8);
        $this->assertEquals($user->email, "parent8@gmail.com");
        $this->assertEquals($user->password, "a8dbbfa41cec833f8dd42be4d1fa9a13142c85c2");
        $userDAO->updateField(8,"password","pwrd1");
        $user=$userDAO->find("id",8);
        $this->assertEquals($user->email, "parent8@gmail.com");
        $this->assertEquals($user->password, "pwrd1");
    }

    public function testDeleteTest() {
        $userDAO = new userDAO();
        $userTest=$userDAO->find("id",8);
        $this->assertEquals($userTest->email, "parent8@gmail.com");
        $this->assertEquals($userTest->password, "a8dbbfa41cec833f8dd42be4d1fa9a13142c85c2");
        $userDAO->delete(8);
        $user=$userDAO->find("id",8);
        $this->assertFalse($user);
    }
    public function testDeleteFromFacilityTest() {
        $userDAO = new userDAO();
        $userTest=$userDAO->find("id",4);
        $this->assertEquals($userTest->email, "employee4@gmail.com");
        $this->assertEquals($userTest->password, "a1d7584daaca4738d499ad7082886b01117275d8");
        $userDAO->deleteUsersOfFacility(2);
        $user=$userDAO->find("id",4);
        $this->assertFalse($user);
    }
}
