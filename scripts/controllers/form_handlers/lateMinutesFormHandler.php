<?php
/**
 * This form handler takes the minutes that the parent is going to be late and updates the child in sql.
 */
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 4/17/15
 * Time: 5:21 PM
 */

require_once(dirname(__FILE__).'/../authController.php');
require_once(dirname(__FILE__) . '/../../errorManager.php');
require_once(dirname(__FILE__) .'/../../cookieManager.php');
require_once(dirname(__FILE__).'/../../models/dao/childDAO.php');

$cdao=new childDAO();
$cid=$_POST['child_id'];
$cminutes=$_POST['minutes'];

$cdao->updateField($cid, "parent_late_minutes", $cminutes);

header("Location:../../../public/displayChild.php?child_id=".$cid);
exit();