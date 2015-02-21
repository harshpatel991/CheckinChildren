<?php


require_once(dirname(__FILE__).'/../../scripts/models/parentModel.php');
require_once(dirname(__FILE__).'/UnitTestBase.php');

class parentModelTest extends unitTestBase {

    public function testConstructor(){
        $parent=new parentModel("Herbert", "pword", "test@test.com", "parent", "8008888989", "123 fake st", 999);

        $this->assertEquals("Herbert", $parent->parent_name);
        $this->assertEquals("pword", $parent->password);
        $this->assertEquals("8008888989", $parent->phone);
        $this->assertEquals("test@test.com", $parent->email);
        $this->assertEquals("123 fake st", $parent->addr);
        $this->assertEquals("parent", $parent->role);
        $this->assertEquals(999, $parent->id);
    }

    public function testFilter(){
        $parent=new parentModel("", "pword", "test@test.com", "parent", "8008888989", "123 fake st", 999);

        $this->assertFalse($parent->isValid());

        $parent->parent_name="Herbert";

        $this->assertTrue($parent->isValid());

        $parent->parent_name="kadjflkfjsdklfjsdlfkjakslfjkdlasfjklajsdflkdjfklasdfjdskajlfkajsfdlfkjdaslfjlasdfkja";

        $this->assertFalse($parent->isValid());
    }

}