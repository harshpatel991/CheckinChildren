<?php

//load the html template and fill in the appropriate values
$htmlFileLocation = dirname(__FILE__).'/../../html/createFacility.html';
$template = file_get_contents ($htmlFileLocation);

$companyId = '50';//TODO: get the company id from session variable -->$_SESSION["id"];

$template = str_replace("LOGGED_IN_COMPANY_ID", $companyId, $template);

if(isset($_GET['error'])) {
    if($_GET['error'] == 1) {
        $template = str_replace("ERROR_MESSAGE", "Invalid information", $template);
    }
} else {
    $template = str_replace("ERROR_MESSAGE", "", $template);
}

echo $template;//print out html