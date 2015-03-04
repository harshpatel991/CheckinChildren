<?php

require_once(dirname(__FILE__) . '/../../cookieManager.php');
require_once(dirname(__FILE__) . '/../../models/dao/childDAO.php');

//Read in POST data from form
$child_id = $_POST['child_id'];

$child = new childModel($_COOKIE[cookieManager::$userId], $_POST["child_name"], $_POST["allergies"], 0, $child_id); // set 0 for values that cannot be changed
for ($i=0; $i<7; $i++){
    $child->expect_checkin[$i] = minutesFromMidnight($_POST['ci-'.$i]);
    $child->expect_checkout[$i] = minutesFromMidnight($_POST['co-'.$i]);
}

if ($child->isUpdateValid()) {
    $childDAO = new ChildDAO();
    $childDAO->update($child);

    header("Location: ../../../public/displayChild.php?child_id=".$child_id); //send browser to the page for newly created facility
    exit();

} else { //redirect to employee creation page with error message
    header("Location: ../../../public/editChild.php?child_id=".$child_id. "&error=1");
    exit();
}


/*
 * $time is a string of format '2:30 am'
 *
 * returns minutes-from-midnight
 */
function minutesFromMidnight($time){
    if(!isset($time) || $time==='' || $time==null) {
        return -1;
    }
    $hmap = preg_split("/[\s:]+/", $time);
    $hmap[0] %= 12;
    if ($hmap[2] === 'pm'){
        $hmap[0] += 12;
    }
    return $hmap[1] + $hmap[0] * 60;
}