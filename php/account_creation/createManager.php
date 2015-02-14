<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]).'/CheckinChildren/php/account_creation/createManagerView.php';

require $root;

//$model = new SvnList('./svn_list.xml', './svn_log.xml');
//$controller = new FileController($model);
$view = new createManagerView();

echo $view->output();