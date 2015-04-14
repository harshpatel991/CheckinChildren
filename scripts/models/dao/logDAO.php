<?php
//require_once(dirname(__FILE__).'/../userModel.php');
require_once(dirname(__FILE__).'/../db/dbConnectionFactory.php');
require_once(dirname(__FILE__).'/../employeeModel.php');
require_once(dirname(__FILE__).'/employeeDAO.php');

/**
 * Class logDAO This class access the logging database, allowing for inserting new log entries and loading facility-specific ones.
 */
class logDAO
{
    //These are all of the phrases for the logs
    public static $transLogin = 'Login';
    public static $transLogout = 'Logout';
    public static $childCheckIn = "Child Checked In";
    public static $childCheckOut = "Child Checked Out";
    public static $childCreated = "Child Created";
    public static $employeeCreated = "Employee Created";
    public static $parentCreated = "Parent Created";
    public static $employeePromotion = "Employee Promoted";
    public static $employeeEdited = "Employee Edited";

    /**
     * @param int $facilityID The facility to load the logs for.
     * @param string $orderedby The column to alphabetize the output by.
     * @return array All of the logs for the given facility in double array form.
     */
    public function findForFacility($facilityID, $orderedby="time_created", $filterTransactionType="%"){
        $connection = DbConnectionFactory::create();
        $query="SELECT * FROM logs WHERE facility_id = :facilityid AND transaction_type LIKE :trasactiontype ORDER BY $orderedby";
        $stmt=$connection->prepare($query);
        $stmt->bindParam(':facilityid', $facilityID);
        $stmt->bindParam(':trasactiontype', $filterTransactionType);
        $stmt->execute();

        $result= $stmt->fetchAll();
        $connection=null;

        return $result;
    }


    /**
     * @param int $primaryID The employee who did this action
     * @param int $secondaryID The entity affected by this action
     * @param string $secondaryName The name of the entity affected
     * @param string $transactionType What transaction has occurred
     * @param string $additionalInfo Used for reporting errors or failures on a transaction attempt
     */
    public function insert($primaryID, $secondaryID, $secondaryName, $transactionType, $additionalInfo="N/A") {
        /*
         * Should insert into logs table: facilityID (query for this), primaryID, secondaryID, transactionType, addionalInfo, dateTime
         */

        $connection = DbConnectionFactory::create();
        $empDAO=new employeeDAO();
        $emp= $empDAO->find($primaryID);
        $primaryName=$emp->emp_name;
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
