<?php
//require_once(dirname(__FILE__).'/../userModel.php');
require_once(dirname(__FILE__).'/../db/dbConnectionFactory.php');
require_once(dirname(__FILE__).'/../employeeModel.php');
require_once(dirname(__FILE__).'/employeeDAO.php');

class logDAO
{
    public static $transLogin = 'Login';
    public static $transLogout = 'Logout';

    public function findForFacility($facilityID){

        $connection = DbConnectionFactory::create();

        $query="SELECT * FROM logs WHERE facility_id = :facilityid";
        $stmt=$connection->prepare($query);
        $stmt->bindParam(':facility_id', $facilityID);

        $stmt->execute();

        $result= $stmt->fetchAll();
        $connection=null;

        return $result;
    }


    public function insert($primaryID, $secondaryID, $primaryName, $secondaryName, $transactionType, $additionalInfo) {
        /*
         * Should insert into logs table: facilityID (query for this), primaryID, secondaryID, transactionType, addionalInfo, dateTime
         */


        $connection = DbConnectionFactory::create();
        $empDAO=new employeeDAO();
        $emp= $empDAO->find($primaryID);
        $facid=$emp->facility_id;
        $query = 'INSERT INTO logs (primary_id, secondary_id, primary_name, secondary_name, facility_id, transaction_type, additional_info)
            VALUES (:primaryID, :secondaryID, :primaryName, :secondaryName, :facilityid, :transactionType, :additionalInfo)';

        $stmt = $connection->prepare($query);
        $stmt->bindParam(':primaryID', $primaryID);
        $stmt->bindParam(':secondaryID', $secondaryID);
        $stmt->bindParam(':facilityid', $facid);
        $stmt->bindParam(':primaryName', $primaryName);
        $stmt->bindParam(':secondaryName', $secondaryName);
        $stmt->bindParam(':transactionType', $transactionType);
        $stmt->bindParam(':additionalInfo', $additionalInfo);
        $stmt->execute();

        $connection=null;
    }

}
