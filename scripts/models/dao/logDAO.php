<?php
//require_once(dirname(__FILE__).'/../userModel.php');
require_once(dirname(__FILE__).'/../db/dbConnectionFactory.php');

class logDAO
{
    public static $transLogin = 'Login';
    public static $transLogout = 'Logout';

    public function findForFacility($facilityID){

    }


    public function insert($primaryID, $secondaryID, $transactionType, $additionalInfo) {
        /*
         * Should insert into logs table: facilityID (query for this), primaryID, secondaryID, transactionType, addionalInfo, dateTime
         */


        $connection = DbConnectionFactory::create();
        $query = 'INSERT INTO users (email, password, role) VALUES (:email, :password, :role)';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':email', $user->email);
        $stmt->bindParam(':password', $user->password);
        $stmt->bindParam(':role', $user->role);
        $stmt->execute();
        $id = $connection->lastInsertId();
        $connection = null;
        return $id;

    }

}
