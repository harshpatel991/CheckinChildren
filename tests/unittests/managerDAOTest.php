<?php
require_once(dirname(__FILE__).'/../../scripts/models/dao/managerDAO.php');
require_once(dirname(__FILE__).'/../../scripts/models/dao/tableCleanerDAO.php');
require_once(dirname(__FILE__).'/../../scripts/models/managerModel.php');


class managerDAOTest extends PHPUnit_Framework_TestCase {
    private $name1 = "test1";
    private $name2 = "test2";
    private $email1 = "1@1";
    private $email2 = "2@2";
    private $facility1 = "1";
    private $facility2 = "2";


    public function testFind(){
        tableCleanerDAO::clean("employee");
        tableCleanerDAO::clean("users");

        $managers = new managerModel();

    }
    public function testCreateManager(){

    }
    public function testGetFacilityManagers(){

    }
    public function testGetCompanyManagers(){

    }
}
