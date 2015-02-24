<?php

require_once(dirname(__FILE__).'/../../scripts/models/childModel.php');
require_once(dirname(__FILE__).'/UnitTestBase.php');

class childModelTest extends PHPUnit_Framework_TestCase {
    public function testConstructor(){
        $child = new childModel(18, "Blue Ranger", "Milk", 99);

        $this->assertEquals(18, $child->parent_id);
        $this->assertEquals("Blue Ranger", $child->child_name);
        $this->assertEquals("Milk", $child->allergies);
        $this->assertEquals(99, $child->child_id);
    }

    public function testInvalidNameLong(){
        $child = new childModel(18, "Blue Rangerrangerrangerrangerrangerranger", "Milk", 99);
        $this->assertFalse($child->isValid());
    }

    public function testInvalidNameShort(){
        $child = new childModel(18, "", "Milk", 99);
        $this->assertFalse($child->isValid());
    }

    public function testInvalidAllergiesLong(){
        $child = new childModel(18, "", "Milk", 99, "AllergyAllergyAllergyAllergyAllergyAllergyAllergyAllergy");
        $this->assertFalse($child->isValid());
    }

    public function testInvalidAllergiesShort(){
        $child = new childModel(18, "", "Milk", 99);
        $this->assertFalse($child->isValid());
    }
}
