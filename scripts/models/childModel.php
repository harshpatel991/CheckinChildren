<?php
require_once(dirname(__FILE__).'/dao/parentDAO.php');
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

   public function expectCheckinReadable(){
       return self::readable($this->expect_checkin);
    }

    public function expectCheckoutReadable(){
        return self::readable($this->expect_checkout);
    }

   private static function readable($arr){
       $readable = [];

       for ($i=0; $i<7; $i++){
           $mfm = $arr[$i];
           if ($mfm < 0){
               $readable[$i] = '';
               continue;
           }
           $min = $mfm % 60;
           $hrs = $mfm / 60;
           $ap = ($hrs >= 12) ?'pm' : 'am';
           $hrs %= 12;
           if ($hrs == 0){
               $hrs = 12;
           }

           $readable[$i] = sprintf("%02d:%02d %s", $hrs, $min, $ap);
       }

       return $readable;
    }
}