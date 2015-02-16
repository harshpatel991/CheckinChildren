<?php
/**
 * Created by PhpStorm.
 * User: matt
 */

require_once(dirname(__FILE__).'/../facilityModel.php');
require_once(dirname(__FILE__).'/../db/dbConnectionFactory.php');

class FacilityDAO
{
    //TODO: Use cache to reduce DB calls.
    //private static $userCache = array();

    public function find($id)
    {
        $connection = DbConnectionFactory::create();
        $query = 'SELECT * FROM facility WHERE facility_id=:facility_id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':facility_id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'facilityModel');
        $user = $stmt->fetch();
        $connection = null;
        return $user;
    }

    public function insert(facilityModel $facility)
    {
        var_dump($facility);
        $connection = DbConnectionFactory::create();
        $query = 'INSERT INTO facility (company_id, address, phone) VALUES (:company_id, :address, :phone)';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':company_id', $facility->company_id);
        $stmt->bindParam(':address', $facility->address);
        $stmt->bindParam(':phone', $facility->phone);
        $stmt->execute();
        $facility_id = $connection->lastInsertId();
        $connection = null;
        return $facility_id;
    }
}
