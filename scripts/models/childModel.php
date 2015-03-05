<?php
require_once(dirname(__FILE__).'/dao/parentDAO.php');
require_once(dirname(__FILE__).'/../dateTimeProvider.php');
require_once(dirname(__FILE__).'/childStatusEnum.php');
class childModel {

    var $child_id;
    var $parent_id;
    var $child_name;
    var $allergies;
    var $facility_id;
    var $last_checkin;
    var $last_checkout;
    var $expect_checkin; //Stored as 'minutes from midnight'
    var $expect_checkout; //Stored as 'minutes from midnight'

    function __construct($parent_id=0, $child_name="", $allergies="", $facility_id=0, $child_id=0) {
        $this->parent_id = $parent_id;
        $this->child_name = $child_name;
        $this->allergies = $allergies;
        $this->facility_id = $facility_id;
        $this->child_id = $child_id;
    }

    public function isValid() {
        if($this->isUpdateValid()) {
            $parentDAO = new parentDAO();
            $parent = $parentDAO->find($this->parent_id);
            if($parent == false) {
                return false;
            } else {
                return true;
            }
        }
        return false;
    }

    public function isUpdateValid() {
        if (strlen($this->child_name) > 30 ||  strlen($this->child_name) <= 0 || strlen($this->allergies) > 50) {
            return false;
        }
        return true;
    }

    public function getStatus($currentTime = null){
        if ($currentTime === null){
            $currentTime = dateTimeProvider::getCurrentDateTime();
        }

        $mfm = 60 * $currentTime['hours'] + $currentTime['minutes'];
        $ciStamp = strtotime($this->last_checkin);
        $coStamp = strtotime($this->last_checkout);
        if ($ciStamp > $coStamp){
            //here
            $co_expect = $this->expect_checkout[$currentTime['wday']];
            if (0 <= $co_expect && $co_expect < $mfm){
                return childStatus::here_due;
            }
            return childStatus::here_ok;
        }
        else{
            //not here
            $ci_expect = $this->expect_checkin[$currentTime['wday']];
            $lastCoStamp = dateTimeProvider::getdate($this->last_checkout);
            $lastcoToday = $lastCoStamp['mon'] === $currentTime['mon']
                && $lastCoStamp['year'] === $currentTime['year'] && $lastCoStamp['mday'] === $currentTime['mday'];
            if ($ci_expect < 0 || $lastcoToday === true){
                return childStatus::not_here_ok;
            }
            if ($ci_expect < $mfm){
                return childStatus::not_here_late;
            }
            return childStatus::not_here_due;
        }
    }

    /*public function getExpectedCheckin($dayOfWeek = -1, $readable = true){
        return self::getExpected($this->expect_checkin, $dayOfWeek, $readable);
    }

    public function getExpectedCheckout($dayOfWeek = -1, $readable = true){
        return self::getExpected($this->expect_checkout, $dayOfWeek, $readable);
    }

    private static function getExpected($arr, $dayOfWeek, $readable){
        if ($dayOfWeek === -1){
            $dayOfWeek = dateTimeProvider::getCurrentDateTime()['wday'];
        }
        if ($readable === true){
            return self::readable($arr[$dayOfWeek]);
        }
        return $arr[$dayOfWeek];
    }*/

   public function expectCheckinReadable(){
       $readable = [];
       for ($i=0; $i<7; $i++){
           $readable[$i] = self::readable($this->expect_checkin[$i]);
       }
       return $readable;
    }

   public function expectCheckoutReadable(){
       $readable = [];
       for ($i=0; $i<7; $i++){
           $readable[$i] = self::readable($this->expect_checkout[$i]);
       }
       return $readable;
    }

   private static function readable($mfm){
       if ($mfm < 0){
           return '';
       }
       $min = $mfm % 60;
       $hrs = $mfm / 60;
       $ap = ($hrs >= 12) ?'pm' : 'am';
       $hrs %= 12;
       if ($hrs == 0){
           $hrs = 12;
       }
       return sprintf("%02d:%02d %s", $hrs, $min, $ap);
    }
}