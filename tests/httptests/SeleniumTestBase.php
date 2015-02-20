<?php

require_once 'WebDriver.php';
require_once 'WebDriver/Driver.php';
require_once 'WebDriver/MockDriver.php';
require_once 'WebDriver/WebElement.php';
require_once 'WebDriver/MockElement.php';
require_once 'WebDriver/FirefoxProfile.php';
require_once 'WebDriver/NoSuchElementException.php';
require_once 'WebDriver/StaleElementReferenceException.php';
require_once 'WebDriver/ElementNotVisibleException.php';
require_once dirname(__FILE__).'/../../scripts/models/db/dbConnectionFactory.php';

class SeleniumTestBase extends PHPUnit_Framework_TestCase {
  protected $driver;
  protected $dbConn;
  private static $serverRunning = false;
  private static $baseUrl = "http://localhost/CheckinChildren/public/"; //Change if necessary for your Apache setup

  public function setUp() {
    shell_exec(sprintf('%s > /dev/null 2>&1 &', 'java -jar ../WebDriver/selenium-server-standalone-2.44.0.jar'));
    sleep(1);
    // If you want to set preferences in your Firefox profile
    $fp = new WebDriver_FirefoxProfile();
    $fp->set_preference("capability.policy.default.HTMLDocument.compatMode", "allAccess");
    $this->driver = WebDriver_Driver::InitAtLocal("4444", "firefox");
    $this->set_implicit_wait(5000);
    $this->load(self::$baseUrl . 'index.php');
    $this->dbConn = DbConnectionFactory::create(true);
    $sql = file_get_contents(dirname(__FILE__).'/../../sql/destroyTables.sql');
    $sql .= file_get_contents(dirname(__FILE__).'/../../sql/createDatabase.sql');
    $sql .= file_get_contents(dirname(__FILE__).'/../../sql/generateTestData.sql');
    $this->dbConn->exec($sql);
  }

  // Forward calls to main driver 
  public function __call($name, $arguments) {
    if (method_exists($this->driver, $name)) {
      return call_user_func_array(array($this->driver, $name), $arguments);
    } else {
      throw new Exception("Tried to call nonexistent method $name with arguments:\n" . print_r($arguments, true));
    }
  }

  public function tearDown() {
    if ($this->driver) {
      if ($this->hasFailed()) {
        $this->driver->set_sauce_context("passed", false);
      } else {
        $this->driver->set_sauce_context("passed", true);
      }
      $this->driver->quit();
    }
    parent::tearDown();
  }
}