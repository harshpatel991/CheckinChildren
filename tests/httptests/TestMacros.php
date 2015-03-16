<?php
require_once 'SeleniumTestBase.php';
require_once 'WebDriver/Driver.php';

class testMacros
{
    public static function login(WebDriver_Driver $driver, $email, $password)
    {
        //sleep(1);
        $driver->get_element("name=email")->send_keys($email);
        $driver->get_element("name=password")->send_keys($password);
        $driver->get_element("id=submit_login")->click();

    }

    public static function createCompany(WebDriver_Driver $driver, $name, $address, $phone, $email, $password)
    {
        $driver->get_element("name=signup")->click();
        $driver->get_element("name=company_name")->send_keys($name);
        $driver->get_element("name=address")->send_keys($address);
        $driver->get_element("name=phone_number")->send_keys($phone);
        $driver->get_element("name=email")->send_keys($email);
        $driver->get_element("name=password")->send_keys($password);
        $driver->get_element("name=submit")->click();
    }
}