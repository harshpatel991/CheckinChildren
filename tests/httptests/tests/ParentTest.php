<?php
require_once dirname(__FILE__).'/../SeleniumTestBase.php';
require_once dirname(__FILE__).'/../TestMacros.php';

class ParentTest extends SeleniumTestBase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testEditParent()
    {
        //Login first
        testMacros::login($this->driver, "parent19@gmail.com", "password19");

        $this->get_element("name=view_parent_profile")->click();
        $this->get_element("id=edit_parent")->click();

        $this->get_element("id=parent_name")->clear(); //clear text input box
        $this->get_element("id=parent_name")->send_keys("New Momma");

        $this->get_element("id=email")->clear();
        $this->get_element("id=email")->send_keys("newmom19@gmail.com");

        $this->get_element("id=address")->clear();
        $this->get_element("id=address")->send_keys("123 New Mom Rd");

        $this->get_element("id=phone_number")->clear();
        $this->get_element("id=phone_number")->send_keys("1231237890");
        $this->get_element("name=carrier")->select_option("AT&T");
        $this->get_element("name=texting")->click();

        $this->get_element("name=submit")->click();

        $page = $this->driver->get_source();
        $this->assertContains("New Momma", $page);
        $this->assertContains("newmom19@gmail.com", $page);
        $this->assertContains("123 New Mom Rd", $page);
        $this->assertContains("1231237890", $page);
        $this->assertContains("text", $page);
    }

    //Attempt to edit parent with an invalid phone number
    public function testEditParentInvalid()
    {
        //Login first
        testMacros::login($this->driver, "parent19@gmail.com", "password19");

        $this->get_element("name=view_parent_profile")->click();
        $this->get_element("id=edit_parent")->click();

        $this->get_element("id=parent_name")->clear(); //clear text input box
        $this->get_element("id=parent_name")->send_keys("New Momma");

        $this->get_element("id=email")->clear();
        $this->get_element("id=email")->send_keys("newmom19@gmail.com");

        $this->get_element("id=address")->clear();
        $this->get_element("id=address")->send_keys("123 New Mom Rd");

        $this->get_element("id=phone_number")->clear();
        $this->get_element("id=phone_number")->send_keys("12312378901");
        $this->get_element("name=carrier")->select_option("AT&T");
        $this->get_element("name=submit")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Invalid Phone Number", $page);
    }

    public function testViewChildren()
    {
        //Login first
        testMacros::login($this->driver, "parent19@gmail.com", "password19");

        $this->get_element("id=view_my_children")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Ludvig Beethoven", $page);
        $this->assertContains("Peter Parker", $page);

        $this->get_element("link=Ludvig Beethoven")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Ludvig Beethoven", $page);
        $this->assertContains("4", $page);
        $this->assertContains("Dogs", $page);
    }

    //Tests changing the name and allergies of a child
    public function testEditChild()
    {
        //Login first
        testMacros::login($this->driver, "parent19@gmail.com", "password19");

        $this->get_element("id=view_my_children")->click();
        $this->get_element("link=Ludvig Beethoven")->click();
        $this->get_element("name=edit_child")->click();

        $this->get_element("name=child_name")->clear();//clear input box
        $this->get_element("name=child_name")->send_keys("New Beethoven");

        $this->get_element("name=allergies")->clear();//clear input box
        $this->get_element("name=allergies")->send_keys("None");

        $this->get_element("name=submit")->click();

        $page = $this->driver->get_source();
        $this->assertContains("New Beethoven", $page);
        $this->assertContains("None", $page);
    }

    //Tests changing child name to invalid value
    public function testEditChildInvalid()
    {
        //Login first
        testMacros::login($this->driver, "parent19@gmail.com", "password19");

        $this->get_element("id=view_my_children")->click();
        $this->get_element("link=Ludvig Beethoven")->click();
        $this->get_element("name=edit_child")->click();

        $this->get_element("name=child_name")->clear();//clear input box
        $this->get_element("name=child_name")->send_keys("Ramalamashamalamadingdong Ganush");


        $this->get_element("name=submit")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Invalid Information", $page);
    }

    public function testChildStatusMissing()
    {
        //Login first
        testMacros::login($this->driver, "parent19@gmail.com", "password19");

        $this->get_element("id=view_my_children")->click();
        $this->get_element("link=Child Missing1")->click();

        $page = $this->driver->get_source();
        $this->assertContains("LATE!", $page);
    }

    public function testChildStatusCheckedout()
    {
        //Login first
        testMacros::login($this->driver, "parent19@gmail.com", "password19");

        $this->get_element("id=view_my_children")->click();
        $this->get_element("link=Child CheckedOut1")->click();

        $page = $this->driver->get_source();
        $this->assertContains("NOT COMING TODAY.", $page);
    }

    public function testChildStatusCheckedin()
    {
        //Login first
        testMacros::login($this->driver, "parent19@gmail.com", "password19");

        $this->get_element("id=view_my_children")->click();
        $this->get_element("link=Child Pickup Later1")->click();

        $page = $this->driver->get_source();
        $this->assertContains("CHECKED IN. EXPECTING PARENT.", $page);
    }

    public function testChildStatusArriving()
    {
        //Login first
        testMacros::login($this->driver, "parent19@gmail.com", "password19");

        $this->get_element("id=view_my_children")->click();
        $this->get_element("link=Child Expected Later2")->click();

        $page = $this->driver->get_source();
        $this->assertContains("ARRIVING.", $page);
    }

    public function testIndexPageAllMisingChilds()
    {
        //Login first
        testMacros::login($this->driver, "parent19@gmail.com", "password19");

        $page = $this->driver->get_source();
        $this->assertContains("Child Missing1", $page);
        $this->assertContains("Child Missing2", $page);
        $this->assertContains("Late Parent1", $page);
        $this->assertContains("Late Parent2", $page);
        $this->assertContains("Ludvig Beethoven", $page);
    }

    public function tearDown(){
        parent::tearDown();
    }

}