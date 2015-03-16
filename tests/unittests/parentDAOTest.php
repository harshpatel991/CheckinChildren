<?php

require_once(dirname(__FILE__).'/../../scripts/models/dao/parentDAO.php');
require_once(dirname(__FILE__).'/UnitTestBase.php');

class parentDAOTest extends unitTestBase
{

    public function testFind()
    {
        $parentDAO=new parentDAO();

        $parent=$parentDAO->find(8);

        $this->assertEquals($parent->parent_name, "Big Daddy");
        $this->assertEquals($parent->id, 8);
        $this->assertEquals($parent->email, "parent8@gmail.com");
        $this->assertEquals($parent->password, "a8dbbfa41cec833f8dd42be4d1fa9a13142c85c2");
        $this->assertequals($parent->contact_pref, "text");
    }

    public function testCreate_Parent()
    {
        $parentDAO=new parentDAO();

        $parentTest = new parentModel("Herbert", "pword", "test@test.com", "parent", "8008888989", "123 fake st", "", 999);
        $id = $parentDAO->create_parent($parentTest);

        $parent=$parentDAO->find($id);

        $this->assertEquals("Herbert", $parent->parent_name);
        $this->assertEquals("8008888989", $parent->phone_number);
        $this->assertEquals("test@test.com", $parent->email);
        $this->assertEquals("parent", $parent->role);
        $this->assertEquals($id, $parent->id);
    }

    public function testFindBadID()
    {
        $parentDAO=new parentDAO();

        $parent=$parentDAO->find(87998);

        $this->assertFalse($parent);
    }

    //Update the parent with id 8
    public function testUpdate() {
        $parentDAO = new parentDAO();

        $parentUpdatedValues = new parentModel("New Name", "garbage", "new@email.com", "parent", "1231231234", "123 New Addr New York 61820", "email", "Verizon", 8);
        $parentDAO->update($parentUpdatedValues);

        $parentUpdated = $parentDAO->find(8);

        $this->assertEquals("New Name", $parentUpdated->parent_name);
        $this->assertEquals("new@email.com", $parentUpdated->email);
        $this->assertEquals("parent", $parentUpdated->role);
        $this->assertEquals("1231231234", $parentUpdated->phone_number);
        $this->assertEquals("123 New Addr New York 61820", $parentUpdated->address);
        $this->assertEquals("email", $parentUpdated->contact_pref);
        $this->assertEquals("Verizon", $parentUpdated->carrier);

        $this->assertNotEquals("garbage", $parentUpdated->password); //password should not change
    }

}
