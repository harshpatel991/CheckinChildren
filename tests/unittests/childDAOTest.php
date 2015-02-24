<?php

require_once(dirname(__FILE__).'/../../scripts/models/dao/childDAO.php');
require_once(dirname(__FILE__).'/UnitTestBase.php');

class childDAOTest extends PHPUnit_Framework_TestCase {

    public function testFind()
    {
        $childDAO=new childDAO();
        $child = $childDAO->find(2);

        $this->assertEquals(2, $child->child_id);
        $this->assertEquals(8, $child->parent_id);
        $this->assertEquals("Mark Zuckerberg", $child->child_name);
        $this->assertEquals("Peanut Butter", $child->allergies);
    }

    public function testCreate_Child()
    {
        $childDAO = new ChildDAO();

        $childTest = new childModel(8, "Red Ranger", "None");
        $child_id = $childDAO->insert($childTest);

        $childFound=$childDAO->find($child_id);

        $this->assertEquals($child_id, $childFound->child_id);
        $this->assertEquals(8, $childFound->parent_id);
        $this->assertEquals("Red Ranger", $childFound->child_name);
        $this->assertEquals("None", $childFound->allergies);
    }

    public function testFindBadID()
    {
        $childDAO = new ChildDAO();
        $child=$childDAO->find(999999);

        $this->assertFalse($child);
    }

}
