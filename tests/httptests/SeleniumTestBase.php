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
require_once dirname(__FILE__).'/../../config.php';

class SeleniumTestBase extends PHPUnit_Framework_TestCase {
  /**
   * @var WebDriver_Driver
   */
  protected $driver;
  protected $dbConn;
  protected $retries = 0;

  public static $baseUrl = "";
  public static $isWindows = false;
  public static $headless = true; //only tested on Matt's machine, talk to him if you want to get it working

  public function setUp() {
    if (self::$isWindows){
      exec('start java -jar ../WebDriver/selenium-server-standalone-2.45.0.jar');
    }
    else if (self::$headless){
      shell_exec(sprintf('%s > /dev/null 2>&1 &', 'export DISPLAY=:99 && java -jar ../WebDriver/selenium-server-standalone-2.45.0.jar'));
    }
    else{
      shell_exec(sprintf('%s > /dev/null 2>&1 &', 'java -jar ../WebDriver/selenium-server-standalone-2.45.0.jar'));
    }

    $this->dbConn = DbConnectionFactory::create();
    $sql = file_get_contents(dirname(__FILE__).'/../../sql/destroyTables.sql');
    $sql .= file_get_contents(dirname(__FILE__).'/../../sql/createDatabase.sql');
    $sql .= file_get_contents(dirname(__FILE__).'/../../sql/generateTestData.sql');
    $this->dbConn->exec($sql);
    sleep(1);

    // If you want to set preferences in your Firefox profile
    $fp = new WebDriver_FirefoxProfile();
    $fp->set_preference("capability.policy.default.HTMLDocument.compatMode", "allAccess");
    $this->driver = WebDriver_Driver::InitAtLocal("4444", "firefox");
    $this->driver->set_implicit_wait(5000);
    $this->driver->set_throttle_factor(1);
    $this->driver->load(self::$baseUrl . 'index.php');

  }

  // Forward calls to main driver 
  public function __call($name, $arguments) {
    if (method_exists($this->driver, $name)) {
      return call_user_func_array(array($this->driver, $name), $arguments);
    } else {
      throw new Exception("Tried to call nonexistent method $name with arguments:\n" . print_r($arguments, true));
    }
  }

  /*
   * Override PHPUnit base functionality to implement retries and screenshots.
   */
  public function runBare(){
    while($this->retries > -1){
      try {
        parent::runBare();
        return;
      }
      catch (Exception $e) {
        // Run again
      }
      $this->retries--;
    }

    if (isset($e)){
      throw $e;
    }
  }

  private function logScreenshot(){
    $time = time();
    $imgName = 'screenshots/screenshot-'.$time.'.png';
    echo "\r\nScreenshot of failure: ".$imgName;
    $imgData = $this->driver->get_screenshot();
    $imgFile = fopen('../'.$imgName, 'w');
    fwrite($imgFile, $imgData);
    fclose($imgFile);
  }

  protected function gotoPage($pageName){
    $this->driver->load(self::$baseUrl.$pageName);
  }

  public function tearDown() {
    if ($this->driver && $this->retries < 1) {
      if ($this->hasFailed()) {
        $this->logScreenshot();
        $this->driver->set_sauce_context("passed", false);
      } else {
        $this->driver->set_sauce_context("passed", true);
      }
    }
    $this->quit();
    parent::tearDown();
  }
}

SeleniumTestBase::$baseUrl = Config::$config['sitepath'];
SeleniumTestBase::$isWindows = Config::$config['isWindows'];
SeleniumTestBase::$headless = isset(Config::$config['headless']) && Config::$config['headless']==true;
