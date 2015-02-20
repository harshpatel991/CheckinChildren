<?php

require_once(dirname(__FILE__).'/../db/dbConnectionFactory.php');

class tableCleanerDAO {

    public function __construct()
    { }

    public static function clean($table){
        $connection = DbConnectionFactory::create();
        $query = "DELETE FROM $table";

        $stmt=$connection->prepare($query);

        $stmt->execute();

        $connection=null;
    }
}