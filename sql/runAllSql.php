<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 3/5/15
 * Time: 3:28 PM
 */
require_once dirname(__FILE__).'/../scripts/models/db/dbConnectionFactory.php';


$dbConn = DbConnectionFactory::create();
$sql = file_get_contents(dirname(__FILE__).'/destroyTables.sql');
$sql .= file_get_contents(dirname(__FILE__).'/createDatabase.sql');
$sql .= file_get_contents(dirname(__FILE__).'/generateTestData.sql');
$dbConn->exec($sql);