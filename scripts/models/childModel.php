<?php

class childModel {

    var $child_id;
    var $parent_id;
    var $child_name;
    var $allergies;

    function __construct($parent_id=0, $child_name="", $allergies="", $child_id=0) {
        $this->child_id = $child_id;
        $this->parent_id = $parent_id;
        $this->child_name = $child_name;
        $this->allergies = $allergies;
    }

    public function isValid() {
        if (strlen($this->child_name) > 30 ||  strlen($this->child_name) <= 0 || strlen($this->allergies) > 50) {
            return false;
        }
        return true;
    }
}