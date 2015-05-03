<?php

require_once(dirname(__FILE__).'/../userModel.php');
require_once(dirname(__FILE__).'/../db/dbConnectionFactory.php');

/**
 * Class userDAO manages user table
 */
class userDAO
{
    /**
     * Retrieves user with field and value
     * @param string $field Field
     * @param string $value Value
     * @return mixed
     */
    public function find($field, $value){
        $connection = DbConnectionFactory::create();
        $query = 'SELECT * FROM users WHERE '.$field.'=:val';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':val', $value);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'userModel');
        $user = $stmt->fetch();
        $connection = null;
        return $user;
    }


    /**
     * Add new user
     * @param userModel $user New user model
     * @return string Id assigned to new user
     */
    public  function insert($user){
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

    /**
     * Update user field with value
     * @param int $userId User id
     * @param string $field Field
     * @param string $value Value
     */
    public function updateField($userId, $field, $value){
        $connection = DbConnectionFactory::create();
        $query = 'UPDATE users SET '.$field.'=:value WHERE id=:id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        $connection = null;
    }

    /**
     * Delete user with id
     * @param int $userId User id
     */
    public function delete($userId){
        $connection = DbConnectionFactory::create();
        $query = "DELETE FROM users WHERE id=:id";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        $connection = null;
    }

    /**
     * Delete all users from facility
     * @param int $facilityID Facility Id
     */
    public function deleteUsersOfFacility($facilityID)
    {
        $connection = DbConnectionFactory::create();
        $query = "DELETE FROM users WHERE EXISTS (SELECT * FROM employee WHERE facility_id = :id and employee.id = users.id)";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':id', $facilityID);
        $stmt->execute();
        $connection = null;
    }

}
