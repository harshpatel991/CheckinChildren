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
        $query = "UPDATE parent SET parent_name=:parent_name, address=:address, phone_number=:phone_number, carrier=:carrier, contact_pref=:contact_pref WHERE id=:id";

        $connection = DbConnectionFactory::create();
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':parent_name', $parent->parent_name);
        $stmt->bindParam(':address', $parent->address);
        $stmt->bindParam(':phone_number', $parent->phone_number);
        $stmt->bindParam(':carrier', $parent->carrier);
        $stmt->bindParam(':contact_pref', $parent->contact_pref);
        $stmt->bindParam(':id', $parent->id);

        $stmt->execute();
        $connection = null;
    }
}