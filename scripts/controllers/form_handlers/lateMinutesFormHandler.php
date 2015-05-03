<?php
/**
 * This form handler takes the minutes that the parent is going to be late and updates the child in sql.
 */

require_once(dirname(__FILE__).'/../authController.php');
require_once(dirname(__FILE__) .'/../../cookieManager.php');
require_once(dirname(__FILE__).'/../../models/dao/childDAO.php');
require_once(dirname(__FILE__).'/../../models/childModel.php');
$cdao=new childDAO();
$cid=$_POST['child_id'];
$cminutes=$_POST['minutes'];

if (childModel::checkMinutes($cminutes)) {

    $cdao->updateField($cid, "parent_late_minutes", $cminutes);

    header("Location:../../../public/displayChild.php?child_id=" . $cid);
}

else{
    header("Location:../../../public/displayChild.php?child_id=" . $cid."&error=47");
}
exit();