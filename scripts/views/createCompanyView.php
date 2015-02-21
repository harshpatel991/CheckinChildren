<?php
$htmlFileLocation = dirname(__FILE__).'/../../html/createCompany.html';

$template=file_get_contents ($htmlFileLocation);
echo $template;