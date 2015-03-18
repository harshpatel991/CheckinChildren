<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/16/15
 * Time: 11:07 PM
 */

require_once(dirname(__FILE__).'/../authController.php');
require_once(dirname(__FILE__).'/../../models/dao/userDAO.php');

$userDAO=new userDAO();
$empid=$_GET['employee_id'];
$userDAO->updateField($empid, "role", "manager");

header("Location: ../../../public/displayEmployee.php?employee_id=" . $empid);