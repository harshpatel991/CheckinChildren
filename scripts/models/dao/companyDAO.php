<?php
/**
 * Created by PhpStorm.
 * User: Elzabad
 */
require_once(dirname(__FILE__).'/../companyModel.php');
require_once(dirname(__FILE__).'/../facilityModel.php');
require_once(dirname(__FILE__).'/../db/dbConnectionFactory.php');
require_once(dirname(__FILE__).'/userDAO.php');

/**
 * Class CompanyDAO manages Company table in database
 */
class CompanyDAO {
    /**
     * Add new company to users table
     * @param companyModel $company Data stored for new company
     * @return string Assigned id to the new company
     */
    public function createCompany(companyModel $company){
        $newCompany=new userModel($company->email, $company->password, $company->role);
        $userDAO=new userDAO();

        $id = $userDAO->insert($newCompany);

        $this->insert($company, $id);
        return $id;
    }

    /**
     * Inserts the specified company in the data base
     * @param companyModel $company Data for new company
     * @param int $id Id of the new company
     * @return string Assigned id to the new company
     */
    public function insert($company, $id) {
        $connection = DbConnectionFactory::create();
        $query = 'INSERT INTO company (id, company_name, address, phone) VALUES (:id,:company_name, :address, :phone)';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':company_name', $company->company_name);
        $stmt->bindParam(':address', $company->address);
        $stmt->bindParam(':phone', $company->phone);
        $stmt->execute();
        $facility_id = $connection->lastInsertId();
        $connection = null;
        return $facility_id;
    }

    /**
     * Retreives a company matching the specified facility id
     * @param int $id Id of the company
     * @return mixed Either Returns false if a company is not found or companyModel Object
     */
    public function find($id) {
        $connection = DbConnectionFactory::create();
        $query = 'SELECT * FROM company NATURAL JOIN users WHERE id=:id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'companyModel');
        $company = $stmt->fetch();
        $connection = null;
        return $company;
    }
    /**
     * Updates the email, parent_name, address, phone_number of a parent
     * @param companyModel $company Data for the updated company
     */
    public function update($company) {
        $userDAO=new userDAO();

        $userDAO->updateField($company->id, 'email', $company->email);

        $connection = DbConnectionFactory::create();
        $query = 'UPDATE company SET company_name=:company_name,address=:address, phone=:phone  WHERE id=:id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':company_name', $company->company_name);
        $stmt->bindParam(':address', $company->address);
        $stmt->bindParam(':phone', $company->phone);
        $stmt->bindParam(':id', $company->id);
        $stmt->execute();
        $connection = null;
    }
}
