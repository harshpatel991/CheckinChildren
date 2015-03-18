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

        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'parentModel');
        $parent=$stmt->fetch();
        $connection=null;

        return $parent;
    }

    public function findAll(){
        $connection = DbConnectionFactory::create();
        $query = "SELECT * FROM parent NATURAL JOIN users";

        $stmt=$connection->prepare($query);

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'parentModel');
        $parents=$stmt->fetchAll();
        $connection=null;

        return $parents;
    }


    public function create_parent($parent){
        $newParent=new userModel($parent->email, $parent->password, $parent->role);
        $userDAO=new userDAO();

        $id=$userDAO->insert($newParent);

        $this->insert($parent->parent_name, $parent->address, $parent->phone_number, $id, $parent->contact_pref, $parent->carrier);

        return $id;
    }

    private function insert( $parent_name, $address, $phone_number, $id, $contact_pref, $carrier){
        $connection = DbConnectionFactory::create();

        $query = "INSERT INTO parent (parent_name, address, phone_number, id, contact_pref, carrier) VALUES ( :parent_name, :address, :phone_number, :id, :contact_pref, :carrier)";
        $stmt=$connection->prepare($query);

        $stmt->bindParam(":parent_name", $parent_name);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":phone_number", $phone_number);
        $stmt->bindParam(":contact_pref", $contact_pref);
        $stmt->bindParam(":carrier", $carrier);


        $stmt->execute();

        $connection=null;
    }

    // Updates the email, parent_name, address, phone_number of a parent
    // **** DOES NOT UPDATE PASSWORD or ID OF PARENT! ****
    public function update($parent) {
        $userDAO=new userDAO();

        $userDAO->updateField($parent->id, 'email', $parent->email);

        $this->updateField($parent->id, 'parent_name', $parent->parent_name);
        $this->updateField($parent->id, 'address', $parent->address);
        $this->updateField($parent->id, 'phone_number', $parent->phone_number);
        $this->updateField($parent->id, 'contact_pref', $parent->contact_pref);
        $this->updateField($parent->id, 'carrier', $parent->carrier);

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