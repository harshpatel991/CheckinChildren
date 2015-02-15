<?php
echo "path: " . realpath($_SERVER["DOCUMENT_ROOT"]) . "/CheckinChildren/php/account_creation/createFacilityView.php";
require realpath($_SERVER["DOCUMENT_ROOT"]) . '/CheckinChildren/php/account_creation/createFacilityView.php';

//$model = new SvnList('./svn_list.xml', './svn_log.xml');
//$controller = new FileController($model);
$view = new createFacilityView();

echo $view->output();