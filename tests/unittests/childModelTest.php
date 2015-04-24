<?php

require_once(dirname(__FILE__).'/../../scripts/models/childModel.php');
require_once(dirname(__FILE__).'/UnitTestBase.php');
require_once(dirname(__FILE__).'/../../scripts/errorManager.php');

class childModelTest extends unitTestBase {
    public function testConstructor(){
        $child = new childModel(18, "Blue Ranger", "Milk", "Jon", 1, 99);

        $this->assertEquals(18, $child->parent_id);
        $this->assertEquals("Blue Ranger", $child->child_name);
        $this->assertEquals("Milk", $child->allergies);
        $this->assertEquals("Jon", $child->trusted_parties);
        $this->assertEquals(1, $child->facility_id);
        $this->assertEquals(99, $child->child_id);
    }

    public function testInvalidNameLong(){
        $child = new childModel(18, "Blue Rangerrangerrangerrangerrangerranger", "Milk", 1, 99);
        $this->assertEquals($child->isValid(), errorEnum::invalid_name);
    }

    public function testInvalidNameShort(){
        $child = new childModel(18, "", "Milk", 1, 99);
        $this->assertEquals($child->isValid(), errorEnum::invalid_name);
    }

    public function testInvalidAllergiesLong(){
        $child = new childModel(8, "Blue Ranger", "AllergyAllergyAllergyAllergyAllergyAllergyAllergyAllergy", 1, 99);
        $this->assertEquals($child->isValid(), errorEnum::invalid_allergies);
    }

    public function testInvalidAllergiesShort(){
        $child = new childModel(8, "Blue Ranger", "", 1, 99);
        $this->assertEquals($child->isValid(), errorEnum::invalid_allergies);
    }

    public function testInvalidParentId() {
        $child = new childModel(99999, "Blue Ranger", "Milk", 1, 99);
        $this->assertEquals($child->isValid(), errorEnum::parent_not_found);
    }

    public function testInvalidCheckinOutTimes(){
        $child = new childModel(8, "Blue Ranger", "Milk", "Jon", 1, 99);
        $child->expect_checkin = [1,1,1,1,1,1,1];
        $child->expect_checkout = [2,2,2,2,2,2,-1];
        $this->assertEquals($child->isValid(), errorEnum::checkout_time_missing);

        $child->expect_checkin = [1,1,1,1,-1,1,1];
        $child->expect_checkout = [2,2,2,2,2,2,2];
        $this->assertEquals($child->isValid(), errorEnum::checkin_time_missing);

        $child->expect_checkin = [1,1,1,1,2,1,1];
        $child->expect_checkout = [2,2,2,2,1,2,2];
        $this->assertEquals($child->isValid(), errorEnum::checkout_less_than_checkin);

        $child->expect_checkin = [-1,1,1,1,-1,1,1];
        $child->expect_checkout = [-1,2,2,2,-1,2,2];
        $this->assertEquals($child->isValid(), errorEnum::no_errors);
    }

    public function testValidMinutes(){
        $this->assertTrue(childModel::checkMinutes(30));
        $this->assertTrue(childModel::checkMinutes(0));
        $this->assertTrue(childModel::checkMinutes(90));
    }

    public function testNegativeMinutes(){
        $this->assertFalse(childModel::checkMinutes(-30));
        $this->assertFalse(childModel::checkMinutes(-800));
    }

    public function testTooLargeMinutes(){
        $this->assertFalse(childModel::checkMinutes(900));
        $this->assertFalse(childModel::checkMinutes(91));
    }

    public function testPositiveInvalidMinutes(){
       $this->assertFalse(childModel::checkMinutes(55));
       $this->assertFalse(childModel::checkMinutes(14));
    }
}
