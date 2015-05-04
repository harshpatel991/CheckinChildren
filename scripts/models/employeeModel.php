<?php
require_once(dirname(__FILE__).'/userModel.php');
require_once(dirname(__FILE__).'/../errorManager.php');

/**
 * Class employeeModel used to represent employees
 */
class employeeModel extends userModel{
    public $emp_name;
    public $facility_id;
    public $phone_number;
    public $address;

    /**
     * Used to construct a new employee
     * @param string $emp_name the employee's name
     * @param string $password their password
     * @param int $facility_id which facility they work at
     * @param string $email their email
     * @param string $role their role will be "employee" or "manager"
     * @param int $id a unique identifier
     * @param string $phone_number their phone number
     * @param string $address their home address
     */
    public function __construct( $emp_name="", $password="", $facility_id=0, $email="", $role="", $id=0, $phone_number="", $address="")
    {
        $this->id=$id;
        $this->emp_name=$emp_name;
        $this->facility_id=$facility_id;
        $this->password=$password;
        $this->email=$email;
        $this->role=$role;
        $this->phone_number=$phone_number;
        $this->address=$address;
    }

    /**
     * Checks if the Employee is valid
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
     * Checks if the update to the employee is valid
     * @return int either 0 for good or some other error code
     */
    public function isUpdateValid() {
        if (strlen($this->emp_name)>30 || strlen($this->emp_name)<=0){
            return errorEnum::invalid_name;
        }
        if (strlen($this->email)>40 || strlen($this->email)<=0 || strpos($this->email, '@')===false) {
            return errorEnum::invalid_email;
        }
        if (strlen($this->password)>40){
            return errorEnum::invalid_password;
        }
        if (strlen($this->phone_number)!=10 || !is_numeric($this->phone_number)){
            return errorEnum::invalid_phone;
        }
        if (strlen($this->address)==0 || strlen($this->address)>50){
            return errorEnum::invalid_address;
        }



        return parent::isUpdateValid();
    }

}