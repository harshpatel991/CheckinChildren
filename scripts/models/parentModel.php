<?php

require_once(dirname(__FILE__).'/userModel.php');
require_once(dirname(__FILE__).'/../errorManager.php');

/**
 * Class parentModel used to represent parents
 */
class parentModel extends userModel{
    public $parent_name;
    public $address;
    public $phone_number;
    public $carrier;
    public $contact_pref;

    /**
     * constructs a new parent
     * @param string $parent_name their name
     * @param string $password their password
     * @param string $email their email
     * @param string $role their role "parent"
     * @param string $phone_number their phone number
     * @param string $address their address
     * @param string $contact_pref how they prefered to be contacted
     * @param string $carrier who their phone carrier is for texting update to them
     * @param int $id a unique identifier
     */
    public function __construct( $parent_name="", $password="", $email="", $role="", $phone_number="",
                                 $address="", $contact_pref="", $carrier="", $id=0)
    {
        $this->id=$id;
        $this->parent_name=$parent_name;
        $this->password=$password;
        $this->email=$email;
        $this->role=$role;
        $this->address=$address;
        $this->phone_number=$phone_number;
        $this->carrier= $carrier;
        $this->contact_pref=$contact_pref;
    }

    /**
     * Checks if a new parent is valid
     * @return int either 0 for good or some other error code
     */
    public function isValid() {
        $error_code = $this->isUpdateValid();
        if ($error_code > 0){
            return $error_code;
        }
        return parent::isValid();
    }

    /**
     * Checks if the update to the parent is valid
     * @return int either 0 for good or some other error code
     */
    public function isUpdateValid() {
        if (strlen($this->parent_name)>30 || strlen($this->parent_name)<=0){
            return errorEnum::invalid_name;
        }
        if (strlen($this->phone_number)!=10 || !is_numeric($this->phone_number)){
            return errorEnum::invalid_phone;
        }
        if (strlen($this->address)==0 || strlen($this->address)>50){
            return errorEnum::invalid_address;
        }
        if (strpos($this->contact_pref,'text')!=false && strlen($this->carrier)==0){
            return errorEnum::missing_carrier;
        }

        return parent::isUpdateValid();
    }

}