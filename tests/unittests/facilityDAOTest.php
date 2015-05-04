<?php
require_once(dirname(__FILE__).'/../../scripts/models/dao/facilityDAO.php');
require_once(dirname(__FILE__).'/../../scripts/models/facilityModel.php');
require_once(dirname(__FILE__).'/UnitTestBase.php');


class facilityDAOTest extends unitTestBase {

    /**
     * Tests inserting into facility database
     */
    public function testInsertFacility() {
        $facilityDAO = new facilityDAO();

        $company_id = 1;
        $address = "123 Wright St.";
        $phone = "1234567890";

        $testFacility = new facilityModel($company_id, $address, $phone);
        $newFacilityId = $facilityDAO->insert($testFacility); //insert into database

        $retrievedFacility = $facilityDAO->find($newFacilityId); //test to see that it was recorded

        $this->assertEquals($newFacilityId, $retrievedFacility->facility_id);
        $this->assertEquals($company_id, $retrievedFacility->company_id);
        $this->assertEquals($address, $retrievedFacility->address);
        $this->assertEquals($phone, $retrievedFacility->phone);
    }

    /**
     * Tests finding an existing facility in the database
     */
    public function testFindFacility() {
        $facilityDAO = new facilityDAO();

        $facility_id = 1;
        $company_id = 1;
        $address = "1 Facility Rd. Champaign IL 61820";
        $phone = "1235933945";

        $retrievedFacility = $facilityDAO->find($facility_id);

        $this->assertEquals($facility_id, $retrievedFacility->facility_id);
        $this->assertEquals($company_id, $retrievedFacility->company_id);
        $this->assertEquals($address, $retrievedFacility->address);
        $this->assertEquals($phone, $retrievedFacility->phone);
    }

    /**
     * Tests finding a facility that does not exist
     */
    public function testFindNonExistentFacility() {
        $facilityDAO = new facilityDAO();
        $facility_id = 999999;

        $retrievedFacility = $facilityDAO->find($facility_id);

        $this->assertEquals(FALSE, $retrievedFacility);
    }

    /**
     * Tests finding all facilities in a company
     */
    public function testFindFacilitiesInCompany() {
        $facilityDAO = new facilityDAO();
        $company_id = 5;

        $facilitiesFound = $facilityDAO->findFacilitiesInCompany($company_id);

        $facility1 = new facilityModel(5, "5 Facility Rd. Champaign IL 61820", "2942956875", 5);
        $facility2 = new facilityModel(5, "6 Facility Rd. Champaign IL 61820", "6875963921", 6);
        $facility3 = new facilityModel(5, "7 Facility Rd. Champaign IL 61820", "2939949969", 7);
        $facilitiesKnown = array($facility1, $facility2, $facility3);

        foreach($facilitiesFound as $facility) {
            $this->assertTrue(in_array($facility, $facilitiesKnown));
        }

        $this->assertEquals(3, count($facilitiesFound));

    }


}
