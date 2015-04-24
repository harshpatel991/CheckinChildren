<?php
/**
 * The form handler when a company submits form to move a child to a different facility
 * Updates the child's facility_id in the database using the childDAO and redirects to displayChild page
 */
require_once(dirname(__FILE__) . '/../authController.php');
require_once(dirname(__FILE__) . '/../../errorManager.php');
require_once(dirname(__FILE__) . '/../../cookieManager.php');
require_once(dirname(__FILE__) . '/../../models/dao/childDAO.php');

$authController = new authController();
$authController->verifyRole(['company']);
$authController->verifyChildPermissions($_GET['child_id']);
$authController->verifyFacilityPermissions($_POST['facility_id']);
$authController->redirectPage('../../../public/');

//Read in POST data from form
$cookieManager = new cookieManager();
$cookies = $cookieManager->getCookies();

$childDAO = new ChildDAO();
$childDAO->updateField($_GET['child_id'], "facility_id",$_POST['facility_id'] );
header("Location: ../../../public/displayChild.php?child_id=".$_GET['child_id']); //send browser to the page for newly created facility
exit();

