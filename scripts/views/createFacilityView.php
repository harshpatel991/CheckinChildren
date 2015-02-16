<?php
    //load the html template and fill in the appropriate values
    $htmlFileLocation = dirname(__FILE__).'/../../html/createFacility.html';

    $template = file_get_contents ($htmlFileLocation);

    $companyId = '50';//TODO: get the company id from session variable -->$_SESSION["id"];
    $template = str_replace("LOGGED_IN_COMPANY_ID", $companyId, $template);

    //print out html

    echo $template;