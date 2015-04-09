<?php
/**
 * Created by PhpStorm.
 * User: Elzabad
 * Date: 2/20/2015
 * Time: 4:41 PM
 */
require_once(dirname(__FILE__).'/../../scripts/models/companyModel.php');
require_once(dirname(__FILE__).'/UnitTestBase.php');

class companyModelTest extends unitTestBase {
    public function testConstructor(){
        $company=new companyModel("Family Daycare", "509 E Stoughton", "2023457654", "test@test.com","testpassword", "company", 21);

        $this->assertEquals("Family Daycare", $company->company_name);
        $this->assertEquals("509 E Stoughton", $company->address);
        $this->assertEquals("2023457654", $company->phone);
        $this->assertEquals("test@test.com", $company->email);
        $this->assertEquals("company", $company->role);
        $this->assertEquals("testpassword", $company->password);
        $this->assertEquals(21, $company->id);
    }

    public function testFilter(){
        $company=new companyModel("", "509 E Stoughton", "2023457654", "test@test.com","testpassword", "company", 21);

        $this->assertEquals($company->isValid(), errorEnum::invalid_name);

        $company->company_name="Family Daycare";

        $this->assertEquals($company->isValid(), errorEnum::no_errors);

        $company->company_name="kadjflkfjsdklfjsdlfkjakslfjkdlasfjklajsdflkdjfklasdfjdskajlfkajsfdlfkjdaslfjlasdfkja";

        $this->assertEquals($company->isValid(), errorEnum::invalid_name);
    }

}
