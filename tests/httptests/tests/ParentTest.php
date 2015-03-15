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

        $this->get_element("name=parent_name")->clear(); //clear text input box
        $this->get_element("name=parent_name")->send_keys("New Momma");

        $this->get_element("name=email")->clear();
        $this->get_element("name=email")->send_keys("newmom19@gmail.com");

        $this->get_element("name=address")->clear();
        $this->get_element("name=address")->send_keys("123 New Mom Rd");

        $this->get_element("name=phone_number")->clear();
        $this->get_element("name=phone_number")->send_keys("1231237890");

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

        $this->get_element("name=parent_name")->clear(); //clear text input box
        $this->get_element("name=parent_name")->send_keys("New Momma");

        $this->get_element("name=email")->clear();
        $this->get_element("name=email")->send_keys("newmom19@gmail.com");

        $this->get_element("name=address")->clear();
        $this->get_element("name=address")->send_keys("123 New Mom Rd");

        $this->get_element("name=phone_number")->clear();
        $this->get_element("name=phone_number")->send_keys("12312378901");

        $this->get_element("name=submit")->click();

        $page = $this->driver->get_source();
        $this->assertContains("Invalid Information", $page);
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

        sleep(1);
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

    public function tearDown(){
        parent::tearDown();
    }

}