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

        $this->assertEquals(1, count($logs));
        $this->assertEquals("Bob Dude", $logs[0]["primary_name"]);
    }

    public function testFindForFacilityOrderedByPrimaryName() {
        $lDAO = new logDAO();
        $logs = $lDAO->findForFacility(2, 'primary_name');

        $this->assertEquals(2, count($logs));
        $this->assertEquals("Bob Dude", $logs[0]["primary_name"]);
        $this->assertEquals("Rick Grimes", $logs[1]["primary_name"]);
    }

    public function testInsert(){


    }
}
