<?php

require_once(dirname(__FILE__).'/../childModel.php');
require_once(dirname(__FILE__).'/../db/dbConnectionFactory.php');

class childDAO {

    function insert($child){
        $connection = DbConnectionFactory::create();

        $query = "INSERT INTO child (child_id, parent_id, child_name, allergies, facility_id) VALUES ( :child_id, :parent_id, :child_name, :allergies, :facility_id)";
        $stmt=$connection->prepare($query);

        $stmt->bindParam(":child_id", $child->child_id);
        $stmt->bindParam(":parent_id", $child->parent_id);
        $stmt->bindParam(":child_name", $child->child_name);
        $stmt->bindParam(":allergies", $child->allergies);
        $stmt->bindParam(":facility_id", $child->facility_id);

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
        $child->expect_checkin = self::timesCsvToArray($child->expect_checkin);
        $child->expect_checkout = self::timesCsvToArray($child->expect_checkout);
        return $child;
    }

    private static function timesCsvToArray($csv){
        $arr = explode(',',$csv);
        $arr['u'] = $arr[0] = intval($arr[0]);
        $arr['m'] = $arr[1] = intval($arr[1]);
        $arr['t'] = $arr[2] = intval($arr[2]);
        $arr['w'] = $arr[3] = intval($arr[3]);
        $arr['r'] = $arr[4] = intval($arr[4]);
        $arr['f'] = $arr[5] = intval($arr[5]);
        $arr['s'] = $arr[6] = intval($arr[6]);
        return $arr;
    }

    private static function timesArrayToCsv($arr){
        $csv = '';
        for($i=0; $i<6; $i++){
            $csv .= $arr[$i].',';
        }
        $csv .= $arr[6];
        return $csv;
    }

    public function findChildrenWithParent($parent_id) {
        $connection=DbConnectionFactory::create();

        $query = "SELECT * FROM child WHERE parent_id = :parent_id ORDER BY child_name ASC";
        $stmt=$connection->prepare($query);

        $stmt->bindParam(":parent_id",$parent_id);
        $stmt->execute();

        $children = $stmt->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'childModel');
        $connection=null;

        return $children;
    }

    // Updates a child's name and allergies
    // *** DOES NOT UPDATE ANY OTHER VALUES OF THE CHILD! ***
    public function update($child) {
        $this->updateField($child->child_id, 'child_name', $child->child_name);
        $this->updateField($child->child_id, 'allergies', $child->allergies);
        $this->updateField($child->child_id, 'expect_checkin', self::timesArrayToCsv($child->expect_checkin));
        $this->updateField($child->child_id, 'expect_checkout', self::timesArrayToCsv($child->expect_checkout));
    }

    private function updateField($child_id, $field, $value){
        $connection = DbConnectionFactory::create();
        $query = 'UPDATE child SET '.$field.'=:value WHERE child_id=:id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':id', $child_id);
        $stmt->execute();
        $connection = null;
    }

}