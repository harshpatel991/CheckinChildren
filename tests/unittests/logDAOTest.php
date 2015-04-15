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
        $this->assertEquals("Bob Dude", $logs[1]["primary_name"]);
    }

    public function testFindForFacilityID3() {
        $lDAO = new logDAO();
        $logs = $lDAO->findForFacility(3, 'time_created');

        $this->assertEquals(12, count($logs));
        for ($i=0; $i<11; $i++) {
            $this->assertEquals("Elzabad Kennedy", $logs[$i]["primary_name"]);
        }
        $this->assertEquals("Bob Dude", $logs[11]["primary_name"]);
    }

    public function testFindForFacilityOrderedByPrimaryName() {
        $lDAO = new logDAO();
        $logs = $lDAO->findForFacility(2, 'primary_name');

        $this->assertEquals(2, count($logs));
        $this->assertEquals("Bob Dude", $logs[0]["primary_name"]);
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
}
