<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 4/4/15
 * Time: 1:26 AM
 */
require_once(dirname(__FILE__).'/../../scripts/models/dao/logDAO.php');
require_once(dirname(__FILE__).'/UnitTestBase.php');

class logDAOTest extends unitTestBase {

    public function testFindForFacilityID2() {
        $lDAO = new logDAO();
        $logs = $lDAO->findForFacility(2, 'time_created');

        $this->assertEquals(2, count($logs));
        $this->assertEquals("Rick Grimes", $logs[0]["primary_name"]);
        $this->assertEquals("A Dude", $logs[1]["primary_name"]);
    }

    public function testFindForFacilityID3() {
        $lDAO = new logDAO();
        $logs = $lDAO->findForFacility(3, 'time_created');

        $this->assertEquals(12, count($logs));
        for ($i=0; $i<11; $i++) {
            $this->assertEquals("Elzabad Kennedy", $logs[$i]["primary_name"]);
        }
        $this->assertEquals("Other Dude", $logs[11]["primary_name"]);
    }

    public function testFindForFacilityOrderedByPrimaryName() {
        $lDAO = new logDAO();
        $logs = $lDAO->findForFacility(2, 'primary_name');

        $this->assertEquals(2, count($logs));
        $this->assertEquals("A Dude", $logs[0]["primary_name"]);
        $this->assertEquals("Rick Grimes", $logs[1]["primary_name"]);
    }

    public function testSimpleInsert(){
        $lDAO = new logDAO();

        $lDAO->insert(13, 57, "Brock Baker", logDAO::$employeeCreated);

        $logs=$lDAO->findForFacility(5, "time_created");
        $myLog=$logs[0];
        $this->assertEquals("Saul Goodman",$myLog['primary_name']);
        $this->assertEquals("Brock Baker", $myLog['secondary_name']);
        $this->assertEquals(13, $myLog['primary_id']);
        $this->assertEquals(57, $myLog['secondary_id']);
        $this->assertEquals("Employee Created", $myLog['transaction_type']);

    }

    public function testDoubleInsert(){
        $lDAO = new logDAO();

        $lDAO->insert(13, 57, "Brock Baker", logDAO::$employeeCreated);
        $lDAO->insert(13, 64, "Dumb Kid", logDAO::$childCreated);

        $logs=$lDAO->findForFacility(5, "time_created");
        $myLog=$logs[0];
        $this->assertEquals("Saul Goodman",$myLog['primary_name']);
        $this->assertEquals("Brock Baker", $myLog['secondary_name']);
        $this->assertEquals(13, $myLog['primary_id']);
        $this->assertEquals(57, $myLog['secondary_id']);
        $this->assertEquals("Employee Created", $myLog['transaction_type']);

        $myLog=$logs[1];
        $this->assertEquals("Saul Goodman",$myLog['primary_name']);
        $this->assertEquals("Dumb Kid", $myLog['secondary_name']);
        $this->assertEquals(13, $myLog['primary_id']);
        $this->assertEquals(64, $myLog['secondary_id']);
        $this->assertEquals("Child Created", $myLog['transaction_type']);
    }

    public function testFindForFacilityFilterCheckedIn() {
        $lDAO = new logDAO();
        $logs = $lDAO->findForFacility(6, 'time_created', "Child Checked In");

        $this->assertEquals(1, count($logs));
        $this->assertEquals("Child Checked In", $logs[0]['transaction_type']);
    }

    public function testFindForFacilityFilterCheckedOut() {
        $lDAO = new logDAO();
        $logs = $lDAO->findForFacility(6, 'time_created', "Child Checked Out");

        $this->assertEquals(1, count($logs));
        $this->assertEquals("Child Checked Out", $logs[0]['transaction_type']);
    }

    public function testFindForFacilityFilterEmployeeCreated() {
        $lDAO = new logDAO();
        $logs = $lDAO->findForFacility(6, 'time_created', "Employee Created");

        $this->assertEquals(1, count($logs));
        $this->assertEquals("Employee Created", $logs[0]['transaction_type']);
    }

    public function testFindForFacilityFilterParentCreated(){
        $lDAO = new logDAO();
        $logs = $lDAO->findForFacility(7, 'time_created', "Parent Created");

        $this->assertEquals(1, count($logs));
        $this->assertEquals("Parent Created", $logs[0]['transaction_type']);
    }

    public function testFindForFacilityFilterChildCreated() {
        $lDAO = new logDAO();
        $logs = $lDAO->findForFacility(7, 'time_created', "Child Created");

        $this->assertEquals(1, count($logs));
        $this->assertEquals("Child Created", $logs[0]['transaction_type']);
    }

    public function testFindForFacilityFilterEmployeePromoted() {
        $lDAO = new logDAO();
        $logs = $lDAO->findForFacility(7, 'time_created', "Employee Promoted");

        $this->assertEquals(1, count($logs));
        $this->assertEquals("Employee Promoted", $logs[0]['transaction_type']);
    }

    public function testFindForFacilityFilterEmployeeEdited() {
        $lDAO = new logDAO();
        $logs = $lDAO->findForFacility(7, 'time_created', "Employee Edited");

        $this->assertEquals(1, count($logs));
        $this->assertEquals("Employee Edited", $logs[0]['transaction_type']);
    }

    public function testFindForCompany() {
        $lDAO = new logDAO();
        $logs = $lDAO->findForCompany(5, 'time_created');

        $this->assertEquals(7, count($logs));
    }

    public function testFindForCompanyOrderByPrimaryName() {
        $lDAO = new logDAO();
        $logs = $lDAO->findForCompany(5, 'transaction_type');

        $this->assertEquals(7, count($logs));

        $this->assertEquals("Child Checked In", $logs[0]['transaction_type']);
        $this->assertEquals("Child Checked Out", $logs[1]['transaction_type']);
        $this->assertEquals("Child Created", $logs[2]['transaction_type']);
        $this->assertEquals("Employee Created", $logs[3]['transaction_type']);
        $this->assertEquals("Employee Edited", $logs[4]['transaction_type']);
        $this->assertEquals("Employee Promoted", $logs[5]['transaction_type']);
        $this->assertEquals("Parent Created", $logs[6]['transaction_type']);
    }

    public function testFindForCompanyFilterEmployeeCreated() {
        $lDAO = new logDAO();
        $logs = $lDAO->findForCompany(5, 'transaction_type', "Employee Created");

        $this->assertEquals(1, count($logs));
        $this->assertEquals("Employee Created", $logs[0]['transaction_type']);
    }

    public function testFindForCompanyFilterParentCreated() {
        $lDAO = new logDAO();
        $logs = $lDAO->findForCompany(5, 'transaction_type', "Parent Created");

        $this->assertEquals(1, count($logs));
        $this->assertEquals("Parent Created", $logs[0]['transaction_type']);
    }

    public function testFindForCompanyFilterChildCheckedIn() {
        $lDAO = new logDAO();
        $logs = $lDAO->findForCompany(5, 'transaction_type', "Child Checked In");

        $this->assertEquals(1, count($logs));
        $this->assertEquals("Child Checked In", $logs[0]['transaction_type']);
    }

    public function testCompanyInsertFacility(){
        $lDAO = new logDAO();
        $lDAO->companyInsert(true, 1,  2, "Test Address", logDAO::$facilityEdited);


        $connection = DbConnectionFactory::create();
        $query = "SELECT * FROM logs WHERE primary_id = 1 ORDER BY transaction_type";
        $stmt=$connection->prepare($query);
        $stmt->execute();

        $result= $stmt->fetchAll();

        $this->assertEquals(1, count($result));
        $this->assertEquals("Facility Edited", $result[0]['transaction_type']);

    }
    public function testCompanyInsertNotFacility(){
        $lDAO = new logDAO();


        $lDAO->companyInsert(false, 1, 10, "steve",logDAO::$demoteManager);
        $lDAO->companyInsert(false, 1, 10, "steve", logDAO::$employeePromotion);


        $connection = DbConnectionFactory::create();
        $query = "SELECT * FROM logs WHERE primary_id = 1 ORDER BY transaction_type";
        $stmt=$connection->prepare($query);
        $stmt->execute();

        $result= $stmt->fetchAll();

        $this->assertEquals(2, count($result));
        $this->assertEquals("Employee Promoted", $result[0]['transaction_type']);
        $this->assertEquals("Manager Demoted", $result[1]['transaction_type']);

    }
}
