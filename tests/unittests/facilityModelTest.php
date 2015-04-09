<?php

require_once(dirname(__FILE__).'/../../scripts/models/facilityModel.php');
require_once(dirname(__FILE__).'/UnitTestBase.php');

class facilityModelTest extends unitTestBase {

    //Test constructor
    public function testConstructor() {
        $facilityModel = new facilityModel(15, "123 Facility Rd Champaign Il 61820", "1234567890", 10);

        $this->assertEquals(15, $facilityModel->company_id);
        $this->assertEquals("123 Facility Rd Champaign Il 61820", $facilityModel->address);
        $this->assertEquals("1234567890", $facilityModel->phone);
        $this->assertEquals(10, $facilityModel->facility_id);
    }

    //Test constructor without specifing the facility id
    public function testDefaultIDConstructor() {
        $facilityModel = new facilityModel(15, "123 Facility Rd Champaign Il 61820", "1234567890");

        $this->assertEquals(15, $facilityModel->company_id);
        $this->assertEquals("123 Facility Rd Champaign Il 61820", $facilityModel->address);
        $this->assertEquals("1234567890", $facilityModel->phone);
        $this->assertEquals(0, $facilityModel->facility_id);
    }

    //Test isValid with valid parameters
    public function testValidIsValid() {
        $facilityModel = new facilityModel(15, "123 Facility Rd Champaign Il 61820", "1234567890");

        $this->assertEquals($facilityModel->isValid(), errorEnum::no_errors);
    }

    //Test isValid with invalid parameters (too long phone number)
    public function testBadPhoneIsValidLong() {
        $facilityModel = new facilityModel(15, "123 Facility Rd Champaign Il 61820", "12345678901");

        $this->assertEquals($facilityModel->isValid(), errorEnum::invalid_phone);
    }

    //Test isValid with invalid parameters (too short phone number)
    public function testBadPhoneIsValidShort() {
        $facilityModel = new facilityModel(15, "123 Facility Rd Champaign Il 61820", "123456789");

        $this->assertEquals($facilityModel->isValid(), errorEnum::invalid_phone);
    }

    //Test isValid with invalid parameters (long address)
    public function testBadAddressIsValidLong() {
        $facilityModel = new facilityModel(15, "123456789010111213141516171819 Facility Rd Champaign Il 61820", "1234567890");

        $this->assertEquals($facilityModel->isValid(), errorEnum::invalid_address);
    }

    //Test isValid with invalid parameters (empty address)
    public function testBadAddressIsValidShort() {
        $facilityModel = new facilityModel(15, "", "1234567890");

        $this->assertEquals($facilityModel->isValid(), errorEnum::invalid_address);
    }

}
