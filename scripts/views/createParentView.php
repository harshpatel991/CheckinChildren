<?php
    $htmlFileLocation = dirname(__FILE__).'/../../html/createParent.html';

    $template=file_get_contents ($htmlFileLocation);
    echo $template;