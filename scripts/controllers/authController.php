<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 2/16/15
 * Time: 4:11 AM
 */

require_once(dirname(__FILE__) . '/../models/dao/userDAO.php');
require_once(dirname(__FILE__).'/../models/userModel.php');
require_once(dirname(__FILE__) . '/../models/dao/childDAO.php');
require_once(dirname(__FILE__).'/../models/childModel.php');
require_once(dirname(__FILE__) . '/../models/dao/employeeDAO.php');
require_once(dirname(__FILE__).'/../models/employeeModel.php');
require_once(dirname(__FILE__) . '/../models/dao/facilityDAO.php');
require_once(dirname(__FILE__).'/../models/facilityModel.php');
require_once(dirname(__FILE__).'/../cookieManager.php');
require_once(dirname(__FILE__).'/../errorManager.php');

class authController
{
    public $authStatus;
    public $authToken;
    public $userId;
    public $userRole;

    public function __construct(){
        if (!isset($_COOKIE[cookieManager::$authToken]) || !isset($_COOKIE[cookieManager::$userId]) || !isset($_COOKIE[cookieManager::$userRole])) {
            $this->authStatus = authStatus::not_logged_in;
            cookieManager::clearAuthCookies();
        }
        else{
            $this->authToken = $_COOKIE[cookieManager::$authToken];
            $this->userId = $_COOKIE[cookieManager::$userId];
            $this->userRole = $_COOKIE[cookieManager::$userRole];
            if (!isset($_SESSION)){
                session_start();
            }
            if (isset($_SESSION['id']) && $_SESSION['id'] == $this->userId
                && isset($_SESSION['token']) && $_SESSION['token'] == $this->authToken
                && isset($_SESSION['role']) && $_SESSION['role'] == $this->userRole){
                $this->authStatus = authStatus::valid;
            }

            else {
                $userDao = new UserDAO();
                $user = $userDao->find('id', $this->userId);

                $authenticated = isset($user) && isset($user->auth_token) && $user->auth_token == $this->authToken
                    && isset($user->role) && $user->role == $this->userRole;

                if ($authenticated) {
                    $this->authStatus = authStatus::valid;
                    $_SESSION['id'] = $this->userId;
                    $_SESSION['token'] = $this->authToken;
                    $_SESSION['role'] = $this->userRole;
                }
                else {
                    $this->authStatus = authStatus::invalid_identity;
                    cookieManager::clearAuthCookies();
                    unset($_SESSION['id']);
                    unset($_SESSION['token']);
                    unset($_SESSION['role']);
                }
            }
        }
    }

    /**
     * @param $validRoles string[] the roles that are valid
     */
    public function verifyRole($validRoles){
        if ($this->authStatus == authStatus::valid && !in_array($this->userRole, $validRoles)){
            $this->authStatus = authStatus::invalid_permissions;
            return false;
        }
        return true;
    }

    public function verifyChildPermissions($childId){
        if ($this->authStatus == authStatus::valid){
            $childDao = new childDAO();
            $child = $childDao->find($childId);
            if ($child == false || !isset($child) || $child == null){
                $this->authStatus = authStatus::invalid_permissions;
                return false;
            }
            else if ($this->userRole == 'manager' || $this->userRole == 'employee'){
                $employeeDao = new employeeDAO();
                $employee = $employeeDao->find($this->userId);
                if ($employee == false || !isset($employee) || $employee == null
                    || $employee->facility_id != $child->facility_id){
                    $this->authStatus = authStatus::invalid_permissions;
                    return false;
                }
                return true;
            }
            else if ($this->userRole == 'parent'){
                if ($child->parent_id != $this->userId){
                    $this->authStatus = authStatus::invalid_permissions;
                    return false;
                }
                return true;
            }
            else{
                $this->authStatus = authStatus::invalid_permissions;
                return false;
            }
        }
        return false;
    }

    public function verifyEmployeePermissions($empId){
        if ($this->authStatus == authStatus::valid) {
            $employeeDao = new employeeDAO();
            $employee = $employeeDao->find($empId);
            if ($employee == false || !isset($employee) || $employee == null) {
                $this->authStatus = authStatus::invalid_permissions;
                return false;
            }
            else if ($this->userRole == 'manager') {
                $manager = $employeeDao->find($this->userId);
                if ($manager == false || !isset($manager) || $manager == null
                    || $employee->facility_id != $manager->facility_id
                ){
                    $this->authStatus = authStatus::invalid_permissions;
                    return false;
                }
                return true;
            }
            else if ($this->userRole == 'company'){
                return $this->verifyFacilityPermissions($employee->facility_id);
            }
            else {
                $this->authStatus = authStatus::invalid_permissions;
                return false;
            }
        }
        return false;
    }

    public function verifyFacilityPermissions($facilityId){
        if ($this->authStatus == authStatus::valid) {
            $facilityDao = new FacilityDAO();
            $facility = $facilityDao->find($facilityId);
            if ($facility == false || !isset($facility) || $facility == null){
                $this->authStatus = authStatus::invalid_permissions;
                return false;
            }
            else if ($facility->company_id != $this->userId){
                $this->authStatus = authStatus::invalid_permissions;
                return false;
            }
            return true;
        }
        return false;
    }

    public function redirectPage(){
        if ($this->authStatus == authStatus::not_logged_in){
            //Not logged in, reditect to login page
            header("Location: login.php");
            exit();
        }
        else if ($this->authStatus == authStatus::invalid_identity){
            //Problem with auth, redirect to error page
            header("Location: login.php?error=".errorEnum::invalid_authentication);
            exit();
        }
        else if ($this->authStatus == authStatus::invalid_permissions){
            //Problem with permissions, redirect to index page
            header("Location: index.php?error=".errorEnum::permission_view_error);
            exit();
        }
    }
}

class authStatus
{
    const valid = 0;
    const not_logged_in = 1;
    const invalid_identity = 2;
    const invalid_permissions = 3;
}