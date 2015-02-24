<?php

require_once(dirname(__FILE__).'/../childModel.php');
require_once(dirname(__FILE__).'/../db/dbConnectionFactory.php');

class childDAO {


    function insert($child){
        $connection = DbConnectionFactory::create();

        $query = "INSERT INTO child (child_id, parent_id, child_name, allergies) VALUES ( :child_id, :parent_id, :child_name, :allergies)";
        $stmt=$connection->prepare($query);

        $stmt->bindParam(":child_id", $child->child_id);
        $stmt->bindParam(":parent_id", $child->parent_id);
        $stmt->bindParam(":child_name", $child->child_name);
        $stmt->bindParam(":allergies", $child->allergies);

        $stmt->execute();
        $child_id = $connection->lastInsertId();

        $connection=null;

        return $child_id;
    }

    public function find($id){
        $connection = DbConnectionFactory::create();
        $query = "SELECT * FROM child WHERE child_id=:id";

        $stmt=$connection->prepare($query);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'childModel');
        $child=$stmt->fetch();
        $connection=null;

        return $child;
    }

}