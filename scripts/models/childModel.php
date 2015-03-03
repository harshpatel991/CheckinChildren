<?php
require_once(dirname(__FILE__).'/dao/parentDAO.php');
class childModel {

    var $child_id;
    var $parent_id;
    var $child_name;
    var $allergies;
    var $facility_id;

    function __construct($parent_id=0, $child_name="", $allergies="", $facility_id=0, $child_id=0) {
        $this->parent_id = $parent_id;
        $this->child_name = $child_name;
        $this->allergies = $allergies;
        $this->facility_id = $facility_id;
        $this->child_id = $child_id;
    }

    public function isValid() {
        $parentDAO = new parentDAO();
        $parent = $parentDAO->find($this->parent_id);
        if (strlen($this->child_name) > 30 ||  strlen($this->child_name) <= 0 || strlen($this->allergies) > 50 || $parent == false) {
            return false;
        }
        return true;
    }
}