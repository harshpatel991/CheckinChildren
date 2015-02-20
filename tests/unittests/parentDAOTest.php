<?php

require_once(dirname(__FILE__).'/../../scripts/models/dao/parentDAO.php');

class parentDAOTest extends PHPUnit_Framework_TestCase
{

    public function testFind()
    {
        $parentDAO=new parentDAO();

        $parent=$parentDAO->find(8);

        $this->assertEquals($parent->parent_name, "Big Daddy");
        $this->assertEquals($parent->id, 8);
        $this->assertEquals($parent->email, "parent8@gmail.com");
        $this->assertEquals($parent->password, "a8dbbfa41cec833f8dd42be4d1fa9a13142c85c2");
    }

    public function testCreate_Parent()
    {
        $parentDAO=new parentDAO();

        $parentTest = new parentModel("Herbert", "pword", "test@test.com", "parent", "8008888989", "123 fake st", 999);
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

}
