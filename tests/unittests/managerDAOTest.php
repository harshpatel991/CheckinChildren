<?php
require_once(dirname(__FILE__).'/../../scripts/models/dao/managerDAO.php');
require_once(dirname(__FILE__).'/../../scripts/models/dao/facilityDAO.php');
require_once(dirname(__FILE__).'/../../scripts/models/managerModel.php');
require_once(dirname(__FILE__).'/../../scripts/models/facilityModel.php');
require_once(dirname(__FILE__).'/UnitTestBase.php');

/**
 * Class managerDAOTest tests managerDAO
 */
class managerDAOTest extends unitTestBase {
    private $name1 = "test1";
    private $name2 = "test2";
    private $pass1 = "pass1";
    private $pass2 = "pass2";
    private $company1 = 7;
    private $company2 = 7;
    private $managerId1 = 98;
    private $managerId2 = 99;
    private $address1 = "1 Address";
    private $address2 = "2 Address";
    private $phone1 = "0123456789";
    private $phone2 = "1234567890";
    private $email1 = "1@1";
    private $email2 = "2@2";
    private $facility1 = "7";
    private $facility2 = "7";

    public function setUp(){
        $dbConn = DbConnectionFactory::create();
        $sql = file_get_contents(dirname(__FILE__).'/../../sql/destroyTables.sql');
        $sql .= file_get_contents(dirname(__FILE__).'/../../sql/createDatabase.sql');
        $dbConn->exec($sql);
        $dbConn = null;
        parent::setUp();
    }
    /**
     * Test find manager
     */
    public function testFind(){
        $manager = new managerModel($this->name1, $this->pass1, $this->facility1, $this->email1, $this->managerId1, $this->address1, $this->phone1);
        $managerDAO = new managerDAO();

        $id = $managerDAO->createManager($manager);

        $tmanagers = $managerDAO->find($id);

        $this->assertEquals($id, $tmanagers->id);
    }

    /**
     * Test get managers in facility
     */
    public function testGetFacilityManagers(){
        $manager1 = new managerModel($this->name1, $this->pass1, $this->facility1, $this->email1, 0, $this->address1, $this->phone1);
        $manager2 = new managerModel($this->name2, $this->pass2, $this->facility1, $this->email2, 0, $this->address2, $this->phone2);

        $managerDAO = new managerDAO();

        $id1 = $managerDAO->createManager($manager1);
        $id2 = $managerDAO->createManager($manager2);
        echo $id1;
        echo $id2;

        $tmanagers = $managerDAO->getFacilityManagers($this->facility1);

        $this->assertEquals($id1, $tmanagers[0]->id);
        $this->assertEquals($id2, $tmanagers[1]->id);
        $this->assertEquals($this->name1, $tmanagers[0]->emp_name);
        $this->assertEquals($this->name2, $tmanagers[1]->emp_name);
    }

    /**
     * Tests Get company Managers
     */
    public function testGetCompanyManagers(){
        $db =
        $mfacility1 = new facilityModel($this->company1, "address","5555555555");
        $mfacility2 = new facilityModel($this->company1, "address","5555555555");

        $managerDAO = new managerDAO();

        $facilityDAO = new facilityDAO();
        $this->facility1 = $facilityDAO->insert($mfacility1);
        $this->facility2 = $facilityDAO->insert($mfacility2);

        $manager1 = new managerModel($this->name1, $this->pass1, $this->facility1, $this->email1, 0, $this->address1, $this->phone1);
        $manager2 = new managerModel($this->name2, $this->pass2, $this->facility2, $this->email2, 0, $this->address2, $this->phone2);


        $id1 = $managerDAO->createManager($manager1);
        $id2 = $managerDAO->createManager($manager2);


        $tmanagers = $managerDAO->getCompanyManagers($this->company1);

        $this->assertEquals($id1, $tmanagers[0]->id);
        $this->assertEquals($id2, $tmanagers[1]->id);
        $this->assertEquals($this->name1, $tmanagers[0]->emp_name);
        $this->assertEquals($this->name2, $tmanagers[1]->emp_name);
    }
}
