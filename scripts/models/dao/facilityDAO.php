<?php

require_once(dirname(__FILE__).'/../facilityModel.php');
require_once(dirname(__FILE__).'/../db/dbConnectionFactory.php');

/**
 * Class FacilityDAO manages facility table
 */
class FacilityDAO {

    /**
     * Inserts the specified facility in the data base
     * @param facilityModel $facility New facility model
     * @return string Id assigned to a new facility
     */
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

    /**
     * Retreives a facility matching the specified facility id. Returns false if a facility is not found
     * @param int $facility_id Facility id
     * @return mixed Retrieved facility model
     */
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

    /**
     * Retrieves all facilities assoicated with a company
     * @param int $companyId Company id
     * @return array Facilities that belong the company
     */
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

    /**
     * Retrieves all facilities
     * @return array Array of all facilities
     */
    public function findAllFacilityIds(){
        $connection = DbConnectionFactory::create();
        $query = 'SELECT facility_id FROM facility';
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $facilities = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $connection = null;

        return $facilities;
    }

    /**
     * Update facility
     * @param facilityModel $facility Updated facility model
     */
    public function update($facility) {
        $this->updateField($facility->facility_id, 'address', $facility->address);
        $this->updateField($facility->facility_id, 'phone', $facility->phone);
    }

    /**
     * Update facility with given field and value
     * @param int $facility_id Facility id
     * @param string $field Field
     * @param string $value Value
     */
    public function updateField($facility_id, $field, $value){
        $connection = DbConnectionFactory::create();
        $query = 'UPDATE facility SET '.$field.'=:value WHERE facility_id=:id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':id', $facility_id);
        $stmt->execute();
        $connection = null;
    }

    /**
     * Delete facility with a given id
     * @param int $facility_id Facility id
     */
    public function delete($facility_id){
        $connection = DbConnectionFactory::create();
        $query = "DELETE FROM facility WHERE facility_id=:id";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $facility_id);
        $stmt->execute();
        $connection = null;
    }
}
