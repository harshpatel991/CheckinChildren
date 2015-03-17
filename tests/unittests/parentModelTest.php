<?php
require_once(dirname(__FILE__).'/../../scripts/models/parentModel.php');
require_once(dirname(__FILE__).'/UnitTestBase.php');

class parentModelTest extends unitTestBase {

    public function testConstructor(){
        $parent=new parentModel("Herbert", "pword", "test@test.com", "parent", "8008888989", "123 fake st", "email", "Verizon", 999);

        $this->assertEquals("Herbert", $parent->parent_name);
        $this->assertEquals("pword", $parent->password);
        $this->assertEquals("8008888989", $parent->phone_number);
        $this->assertEquals("test@test.com", $parent->email);
        $this->assertEquals("123 fake st", $parent->address);
        $this->assertEquals("parent", $parent->role);
        $this->assertEquals(999, $parent->id);
        $this->assertEquals("email", $parent->contact_pref);
        $this->assertEquals("Verizon", $parent->carrier);
    }

    public function testValidName() {
        $parent = new parentModel("Herbert", "pword", "test@test.com", "parent", "8008888989", "123 fake st", "email", "Verizon", 999);
        $this->assertTrue($parent->isValid());
    }

    public function testInvalidNameLong() {
        $parent = new parentModel("kadjflkfjsdklfjsdlfkjakslfjkdlasfjklajsdflkdjfklasdfjdskajlfkajsfdlfkjdaslfjlasdfkja", "pword", "test@test.com", "parent", "8008888989", "123 fake st","email", "Verizon", 0, 999);
        $this->assertFalse($parent->isValid());
    }

    public function testInvalidShortName() {
        $parent = new parentModel("", "pword", "test@test.com", "parent", "8008888989", "123 fake st", "email", "Verizon", 999);
        $this->assertFalse($parent->isValid());
    }

    public function testInvalidShortPassword() {
        $parent=new parentModel("Herbert", "", "test@test.com", "parent", "8008888989", "123 fake st", "email", "Verizon", 999);
        $this->assertFalse($parent->isValid());
    }

    //Short password is okay for an update
    public function testValidUpdatePassword() {
        $parent=new parentModel("Herbert", "n", "test@test.com", "parent", "8008888989", "123 fake st", "email", "Verizon", 999);
        $this->assertTrue($parent->isUpdateValid());
    }

}