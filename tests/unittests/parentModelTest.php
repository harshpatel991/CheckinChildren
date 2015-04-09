<?php
require_once(dirname(__FILE__).'/../../scripts/models/parentModel.php');
require_once(dirname(__FILE__).'/UnitTestBase.php');
require_once(dirname(__FILE__).'/../../scripts/errorManager.php');

class parentModelTest extends unitTestBase {

    public function testConstructor(){
        $parent=new parentModel("Herbert", "pword", "test@test.com", "parent", "8008888989", "123 fake st", "email", "Verizon Wireless", 999);

        $this->assertEquals("Herbert", $parent->parent_name);
        $this->assertEquals("pword", $parent->password);
        $this->assertEquals("8008888989", $parent->phone_number);
        $this->assertEquals("test@test.com", $parent->email);
        $this->assertEquals("123 fake st", $parent->address);
        $this->assertEquals("parent", $parent->role);
        $this->assertEquals(999, $parent->id);
        $this->assertEquals("email", $parent->contact_pref);
        $this->assertEquals("Verizon Wireless", $parent->carrier);
    }

    public function testValidName() {
        $parent = new parentModel("Herbert", "pword", "test@test.com", "parent", "8008888989", "123 fake st", "email", "Verizon Wireless", 999);
        $this->assertEquals($parent->isValid(), errorEnum::no_errors);
    }

    public function testInvalidNameLong() {
        $parent = new parentModel("kadjflkfjsdklfjsdlfkjakslfjkdlasfjklajsdflkdjfklasdfjdskajlfkajsfdlfkjdaslfjlasdfkja", "pword", "test@test.com", "parent", "8008888989", "123 fake st","email", "Verizon Wireless", 0, 999);
        $this->assertEquals($parent->isValid(), errorEnum::invalid_name);
    }

    public function testInvalidShortName() {
        $parent = new parentModel("", "pword", "test@test.com", "parent", "8008888989", "123 fake st", "email", "Verizon Wireless", 999);
        $this->assertEquals($parent->isValid(), errorEnum::invalid_name);
    }

    public function testInvalidPhoneNumbers() {
        $parent = new parentModel("", "pword", "test@test.com", "parent", "80088889890", "123 fake st", "email", "Verizon Wireless", 999);
        $this->assertEquals($parent->isValid(), errorEnum::invalid_phone);

        $parent = new parentModel("", "pword", "test@test.com", "parent", "800888898a", "123 fake st", "email", "Verizon Wireless", 999);
        $this->assertEquals($parent->isValid(), errorEnum::invalid_phone);

        $parent = new parentModel("", "pword", "test@test.com", "parent", "123456789", "123 fake st", "email", "Verizon Wireless", 999);
        $this->assertEquals($parent->isValid(), errorEnum::invalid_phone);

        $parent = new parentModel("", "pword", "test@test.com", "parent", "", "123 fake st", "email", "Verizon Wireless", 999);
        $this->assertEquals($parent->isValid(), errorEnum::invalid_phone);
    }

    public function testInvalidEmail() {
        $parent=new parentModel("Herbert", "", "notanemail", "parent", "8008888989", "123 fake st", "email", "Verizon Wireless", 999);
        $this->assertEquals($parent->isValid(), errorEnum::invalid_email);

        $parent=new parentModel("Herbert", "", "", "parent", "8008888989", "123 fake st", "email", "Verizon Wireless", 999);
        $this->assertEquals($parent->isValid(), errorEnum::invalid_email);
    }

    public function testInvalidCarrier() {
        $parent=new parentModel("Herbert", "", "notanemail", "parent", "8008888989", "123 fake st", "email", "", 999);
        $this->assertEquals($parent->isValid(), errorEnum::missing_carrier);
    }

    public function testInvalidShortPassword() {
        $parent=new parentModel("Herbert", "", "test@test.com", "parent", "8008888989", "123 fake st", "email", "Verizon Wireless", 999);
        $this->assertEquals($parent->isValid(), errorEnum::invalid_password);
    }

    //Short password is okay for an update
    public function testValidUpdatePassword() {
        $parent=new parentModel("Herbert", "n", "test@test.com", "parent", "8008888989", "123 fake st", "email", "Verizon Wireless", 999);
        $this->assertEquals($parent->isValid(), errorEnum::no_errors);
    }

}