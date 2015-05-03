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
    private $company1 = 1;
    private $company2 = 1;
    private $email1 = "1@1";
    private $email2 = "2@2";
    private $facility1 = "1";
    private $facility2 = "1";

    /**
     * Test find manager
     */
    public function testFind(){
        $manager = new managerModel($this->name1, $this->pass1, $this->facility1, $this->company1, $this->email1);
        $managerDAO = new managerDAO();

        $id = $managerDAO->createManager($manager);

        $tmanagers = $managerDAO->find($id);

        $this->assertEquals($id, $tmanagers->id);
    }

    /**
     * Test get managers in facility
     */
    public function testGetFacilityManagers(){
        $manager1 = new managerModel($this->name1, $this->pass1, $this->facility1, $this->company1, $this->email1);
        $manager2 = new managerModel($this->name2, $this->pass2, $this->facility2, $this->company2, $this->email2);

        $managerDAO = new managerDAO();

        $id1 = $managerDAO->createManager($manager1);
        $id2 = $managerDAO->createManager($manager2);

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
        $mfacility1 = new facilityModel($this->company1, "address","5555555555");
        $mfacility2 = new facilityModel($this->company1, "address","5555555555");

        $managerDAO = new managerDAO();

        $facilityDAO = new facilityDAO();
        $this->facility1 = $facilityDAO->insert($mfacility1);
        $this->facility2 = $facilityDAO->insert($mfacility2);

        $manager1 = new managerModel($this->name1, $this->pass1, $this->facility1, $this->company1, $this->email1);
        $manager2 = new managerModel($this->name2, $this->pass2, $this->facility2, $this->company2, $this->email2);


        $id1 = $managerDAO->createManager($manager1);
        $id2 = $managerDAO->createManager($manager2);


        $tmanagers = $managerDAO->getCompanyManagers($this->company1);

        $this->assertEquals($id1, $tmanagers[0]->id);
        $this->assertEquals($id2, $tmanagers[1]->id);
        $this->assertEquals($this->name1, $tmanagers[0]->emp_name);
        $this->assertEquals($this->name2, $tmanagers[1]->emp_name);
    }
}
