<?php

class childModel {

    var $child_id;
    var $parent_id;
    var $child_name;
    var $allergies;
    var $facility_id;
    var $last_checkin;
    var $last_checkout;
    var $expect_checkin;

    function __construct($parent_id=0, $child_name="", $allergies="",$facility_id=0, $child_id=0,
                         $last_checkin=0, $last_checkout=0) {
        $this->parent_id = $parent_id;
        $this->child_name = $child_name;
        $this->allergies = $allergies;
        $this->facility_id = $facility_id;
        $this->child_id = $child_id;
        $this->$last_checkin = $last_checkin;
        $this->$last_checkout = $last_checkout;
        $this->expect_checkin = [];
    }

    public function isValid() {
        if (strlen($this->child_name) > 30 ||  strlen($this->child_name) <= 0 || strlen($this->allergies) > 50) {
            return false;
        }
        return true;
    }
}