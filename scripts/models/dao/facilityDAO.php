<?php
/**
 * Created by PhpStorm.
 * User: matt
 */

require_once(dirname(__FILE__).'/../facilityModel.php');
require_once(dirname(__FILE__).'/../db/dbConnectionFactory.php');

class FacilityDAO {

    //Inserts the specified facility in the data base
    public function insert(facilityModel $facility) {
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

    //Retreives a facility matching the specified facility id
    //Returns false if a facility is not found
    public function find($facility_id) {
        $connection = DbConnectionFactory::create();
        $query = 'SELECT * FROM facility WHERE facility_id=:facility_id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':facility_id', $facility_id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'facilityModel');
        $facility = $stmt->fetch();
        $connection = null;
        return $facility;
    }

    //Retrieves all facilities assoicated with a company
    public function findFacilitiesInCompany($companyId) {
        $connection = DbConnectionFactory::create();
        $query = 'SELECT * FROM facility WHERE company_id=:company_id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':company_id', $companyId);
        $stmt->execute();
        $facilities = $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'facilityModel');
        $connection = null;

        return $facilities;
    }
}
