<?php
    $htmlFileLocation = dirname(__FILE__).'/../../html/createEmployee.html';

    $template=file_get_contents ($htmlFileLocation);
    echo $template;