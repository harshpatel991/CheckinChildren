<?php
$root = realpath($_SERVER["DOCUMENT_ROOT"]).'/CheckinChildren/html/account_creation/createManager.html';

define("fileHtml", $root);

class createManagerView {

    private $model;
    private $controller;

//    public function __construct() { //TODO: remove this when controller and model are added
//
 //       }

//    public function __construct($controller,$model) {
//        $this->controller = $controller;
//        $this->model = $model;
//    }

    public function output() {
        $template = file_get_contents (fileHtml);

        //TODO: replace any strings here

        echo $template;
    }

}