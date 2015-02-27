<?php


require_once(dirname(__FILE__).'/../parentModel.php');
require_once(dirname(__FILE__).'/../db/dbConnectionFactory.php');
require_once(dirname(__FILE__).'/userDAO.php');
class parentDAO {

    public function __construct()
    { }

    public function find($id){
        $connection = DbConnectionFactory::create();
        $query = "SELECT * FROM parent NATURAL JOIN users WHERE id=:id";

        $stmt=$connection->prepare($query);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'parentModel'); //MAY NEED FETCH_PROPS_LATE FLAG. see below
        $parent=$stmt->fetch();
        $connection=null;

        return $parent;
    }

    public function create_parent($parent){
        $newParent=new userModel($parent->email, $parent->password, $parent->role);
        $userDAO=new userDAO();

        $id=$userDAO->insert($newParent);

        $this->insert($parent->parent_name, $parent->addr, $parent->phone, $id);

        return $id;
    }

    private function insert( $parent_name, $addr, $phone, $id){
        $connection = DbConnectionFactory::create();

        $query = "INSERT INTO parent (parent_name, address, phone_number, id) VALUES ( :parent_name, :addr, :phone, :id)";
        $stmt=$connection->prepare($query);

        $stmt->bindParam(":parent_name", $parent_name);
        $stmt->bindParam(":addr", $addr);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":phone", $phone);


        $stmt->execute();

        $connection=null;
    }

    public function update($parent) {
        $userDAO=new userDAO();

        $userDAO->updateField($parent->id, 'email', $parent->email);

        $this->updateField($parent->id, 'parent_name', $parent->parent_name);
        $this->updateField($parent->id, 'address', $parent->address);
        $this->updateField($parent->id, 'phone_number', $parent->phone_number);
    }

    private function updateField($userId, $field, $value){
        $connection = DbConnectionFactory::create();
        $query = 'UPDATE parent SET '.$field.'=:value WHERE id=:id';
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':value', $value);
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        $connection = null;
    }

}