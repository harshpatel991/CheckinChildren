<?php


require_once(dirname(__FILE__).'/../parentModel.php');
require_once(dirname(__FILE__).'/../db/dbConnectionFactory.php');
require_once(dirname(__FILE__).'/userDAO.php');

/**
 * Class parentDAO manages parent table
 */
class parentDAO {

    /**
     * Default contructor
     */
    public function __construct()
    { }

    /**
     * Retrieves parent with id
     * @param int $id Parent id
     * @return mixed Retrieved Parent model
     */
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

    /**
     * Get all parents
     * @return array Array of All Parents
     */
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


    /**
     * Create a new parent
     * @param parentModel $parent A new parent model
     * @return string Id assigned to a new parent
     */
    public function create_parent($parent){
        $newParent=new userModel($parent->email, $parent->password, $parent->role);
        $userDAO=new userDAO();

        $id=$userDAO->insert($newParent);

        $this->insert($parent->parent_name, $parent->address, $parent->phone_number, $id, $parent->contact_pref, $parent->carrier);

        return $id;
    }

    /**
     * Insert parent to parent table
     * @param string $parent_name Parent's name
     * @param string $address Parent's address
     * @param string $phone_number Parent's phone number
     * @param int $id Id
     * @param string $contact_pref Alert preference
     * @param string $carrier Carrier preference
     */
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

    /**
     * Updates the email, parent_name, address, phone_number of a parent
     * @param parentModel $parent Updated parent model
     */
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