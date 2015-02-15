<?php

define("fileHtml", realpath($_SERVER["DOCUMENT_ROOT"]) . "/CheckinChildren/html/account_creation/createFacility.html");

class createFacilityView {

    public function __construct() {
    }

    public function output() {
        $template = file_get_contents (fileHtml);

        //TODO: replace any strings here

        echo $template;
    }

}
