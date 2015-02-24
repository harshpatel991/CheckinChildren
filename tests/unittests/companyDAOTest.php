<?php
/**
 * Created by PhpStorm.
 * User: Elzabad
 * Date: 2/21/2015
 * Time: 1:15 AM
 */

require_once(dirname(__FILE__).'/../../scripts/models/dao/companyDAO.php');
require_once(dirname(__FILE__).'/../../scripts/models/companyModel.php');

class companyDAOTest extends PHPUnit_Framework_TestCase {
//Tests inserting into facility database
    public function testCreateFacility() {
        $companyDAO = new companyDAO();

        $testCompany=new companyModel("Family Daycare", "509 E Stoughton", "2023457654", "test@test.com",sha1("testpassword"), "company");

        $testCompanyID = $companyDAO->createCompany($testCompany);
        $company = $companyDAO->find($testCompanyID);


        $this->assertEquals($company->company_name, "Family Daycare");
        $this->assertEquals($company->address, "509 E Stoughton");
        $this->assertEquals($company->phone, "2023457654");
        $this->assertEquals($company->id, $testCompanyID);
        $this->assertEquals($company->email, "test@test.com");
        $this->assertEquals($company->password, sha1("testpassword"));
        $this->assertEquals($company->role, "company");

    }

    //Tests finding an existing facility in the database
    public function testFindCompany() {
        $companyDAO = new companyDAO();

        $testId = 1;
        $retrievedCompany = $companyDAO->find($testId);

        $this->assertEquals($retrievedCompany->company_name, "Company 1");
        $this->assertEquals($retrievedCompany->address, "1 Fake St.\n Champaign IL 61820");
        $this->assertEquals($retrievedCompany->phone, "847123456");
        $this->assertEquals($retrievedCompany->id, $testId);
        $this->assertEquals($retrievedCompany->email, "bigcompany1@gmail.com");
        $this->assertEquals($retrievedCompany->password, sha1("password1"));
        $this->assertEquals($retrievedCompany->role, "company");
    }

    //Tests finding a facility that does not exist
    public function testFindNonExistentCompany() {
        $companyDAO = new companyDAO();
        $company_id = 999999;

        $retrievedCompany = $companyDAO->find($company_id);

        $this->assertEquals(FALSE, $retrievedCompany);
    }
}
