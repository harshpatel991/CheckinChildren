<?php require_once(dirname(__FILE__).'/../cookieManager.php');
      require_once(dirname(__FILE__).'/../controllers/managerController.php');
      require_once(dirname(__FILE__).'/../models/dao/employeeDAO.php');
      require_once(dirname(__FILE__).'/../models/employeeModel.php');?>

<h1>Welcome to Checkin Children</h1>
<div id="signed-in"><h3>Currently signed in as a <?php echo $_COOKIE[cookieManager::$userRole]?></h3></div>

<?php
    if ($_COOKIE[cookieManager::$userRole]=='manager') {
        $htmlFileLocation = dirname(__FILE__).'/../../html/managerIndex.html';

        $managercontroller= new managerController();

        $employeedao=new employeeDAO();
        $manager = $employeedao->find($_COOKIE[cookieManager::$userId]);
        $employees=$employeedao->getFacilityEmployees($manager->facility_id);

        $emplist="";

        foreach ($employees as $employee) {
            $emplist=$emplist.($employee->emp_name)."<br>";
        }

        $template=file_get_contents ($htmlFileLocation);
        $template=str_replace(EMPLOYEE_LIST, $emplist, $template);
        echo $template;
    }

    else if ($_COOKIE[cookieManager::$userRole]=='company') {
        ?> <a href="displayFacilities.php">View My Facilities</a> <?php
    }

?>
<form method="post" action="../scripts/controllers/logoutController.php">
    <input type="submit" name="submit" value="Logout">
</form>