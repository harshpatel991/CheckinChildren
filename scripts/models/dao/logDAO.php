<?php
//require_once(dirname(__FILE__).'/../userModel.php');
require_once(dirname(__FILE__).'/../db/dbConnectionFactory.php');
require_once(dirname(__FILE__).'/../employeeModel.php');
require_once(dirname(__FILE__).'/employeeDAO.php');
require_once(dirname(__FILE__).'/../logModel.php');
require_once(dirname(__FILE__).'/facilityDAO.php');
require_once(dirname(__FILE__) . '/companyDAO.php');

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
    public static $facilityEdited = "Facility Edited";
    public static $demoteManager = "Manager Demoted";
    public static $deleteEmployee = "Employee Deleted";

    /**
     * Finds the logs for the specified facility
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
     * Finds all logs for all facilities in the specified company
     * @param int $companyID The companyID of the company whose logs will be retrieved
     * @param string $orderedby The column name by which the logs should be ordered
     * @param string $filterTransactionType The transaction type that should be shown
     * @return array of logs that fit the specified criteria
     */
    public function findForCompany($companyID, $orderedby="time_created", $filterTransactionType="%"){
        $facilityDAO = new FacilityDAO();
        $facilities = $facilityDAO->findFacilitiesInCompany($companyID);

        $facilityIDs = array();
        foreach($facilities as $facility) {
            array_push($facilityIDs, intval($facility->facility_id));
        }

        $facilityIDs = join(',', $facilityIDs);

        $connection = DbConnectionFactory::create();
        $query="SELECT * FROM logs WHERE facility_id IN ($facilityIDs) AND transaction_type LIKE :trasactiontype ORDER BY $orderedby";
        $stmt=$connection->prepare($query);
        $stmt->bindParam(':trasactiontype', $filterTransactionType);
        $stmt->execute();

        $result= $stmt->fetchAll();
        $connection=null;

        return $result;
    }


    /**
     * Inserts a record into the logs
     * @param int $primaryID The employee who did this action
     * @param int $secondaryID The entity affected by this action
     * @param string $secondaryName The name of the entity affected
     * @param string $transactionType What transaction has occurred
     * @param string $additionalInfo Used for reporting errors or failures on a transaction attempt
     */
    public function insert($primaryID, $secondaryID, $secondaryName, $transactionType, $additionalInfo="N/A") {
        //Should insert into logs table: facilityID (query for this), primaryID, secondaryID, transactionType, addionalInfo, dateTime

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

    /**
     * Inserts a company record into the logs
     * @param bool $isFacilityEdit Is this a record of a facility edit
     * @param int $primaryID The id of the company
     * @param int $secondaryID The secondary actors ID (if any)
     * @param string $secondaryName The name of the secondary actor
     * @param string $transactionType The type of transaction that occured
     * @param string $additionalInfo Used for reporting errors or failures on a transaction attempt
     */
    public function companyInsert($isFacilityEdit, $primaryID, $secondaryID, $secondaryName, $transactionType, $additionalInfo="N/A") {
        $connection = DbConnectionFactory::create();

        $compDAO=new companyDAO();

        $comp= $compDAO->find($primaryID);

        $primaryName=$comp->company_name;

        $empDAO=new employeeDAO();
        $emp= $empDAO->find($secondaryID);
        $facid =$emp->facility_id;
        if ($isFacilityEdit)
        {
            $facid = $secondaryID;
        }

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

    /**
     * Retreives the log information about a certain child
     * @param int $childId The id of the child whose logs to search for
     * @param int $limit The limit of logs to retrieve
     * @return array List of logs
     */
    public function getChildHistory($childId, $limit){
        $childEvents = array(self::$childCheckIn, self::$childCheckOut, self::$childCreated);
        $connection = DbConnectionFactory::create();
        $query="SELECT * FROM logs WHERE secondary_id = :childId AND ( ";
        for ($i=0; $i<sizeof($childEvents)-1; $i++){
            $query.="transaction_type='".$childEvents[$i]."' OR ";
        }
        $query.="transaction_type='".$childEvents[sizeof($childEvents)-1]."') ";
        $query.="ORDER BY time_created desc LIMIT ".$limit;
        $stmt=$connection->prepare($query);
        $stmt->bindParam(':childId', $childId);
        $stmt->execute();

        $result= $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'logModel');
        $connection=null;

        return $result;
    }

}
