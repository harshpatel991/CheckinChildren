<?php
require_once(dirname(__FILE__).'/dao/parentDAO.php');
require_once(dirname(__FILE__).'/dao/facilityDAO.php');
require_once(dirname(__FILE__).'/../dateTimeProvider.php');
require_once(dirname(__FILE__).'/childStatusEnum.php');
/**
 * Class childModel this class is used for child functions
 */
class childModel {

    var $child_id;
    var $parent_id;
    var $child_name;
    var $allergies;
    var $trusted_parties;
    var $facility_id;
    var $last_checkin;
    var $last_checkout;
    var $expect_checkin; //Stored as 'minutes from midnight'
    var $expect_checkout; //Stored as 'minutes from midnight'
    var $last_message_status;
    var $parent_late_minutes;

    /**
     * Creates a child model
     * @param int $parent_id the id of the child's parent
     * @param string $child_name the name of the child
     * @param string $allergies a string that contains the childs allergies
     * @param string $trusted_parties a string that contains the names of other adults who can pick up the child
     * @param int $facility_id the id of the facility the child attends
     * @param int $child_id a unique identifier for the child
     * @param int $last_message_status most recent status
     */
    function __construct($parent_id=0, $child_name="", $allergies="", $trusted_parties="", $facility_id=0, $child_id=0, $last_message_status=-1) {
        $this->parent_id = $parent_id;
        $this->child_name = $child_name;
        $this->allergies = $allergies;
        $this->trusted_parties = $trusted_parties;
        $this->facility_id = $facility_id;
        $this->child_id = $child_id;
        $this->last_message_status = $last_message_status;
    }

    /**
     * Checks if the child is valid
     * @return int either 0 for good or some other error code
     */
    public function isValid() {
        $error_code = $this->isUpdateValid();
        if($error_code > 0) {
            return $error_code;
        }

        $parentDAO = new parentDAO();
        $parent = $parentDAO->find($this->parent_id);
        if($parent == false) {
            return errorEnum::parent_not_found;
        }

        $facilityDao = new FacilityDAO();
        $facility = $facilityDao->find($this->facility_id);
        if($facility == false) {
            return errorEnum::facility_not_found;
        }

        return errorEnum::no_errors;
    }

    /**
     * checks if the changes made are valid for updatinga childs info
     * @return int either 0 for good or some other error code
     */
    public function isUpdateValid() {
        if (strlen($this->child_name) > 30 ||  strlen($this->child_name) <= 0){
            return errorEnum::invalid_name;
        }
        if(strlen($this->allergies) > 50 || strlen($this->allergies) === 0){
            return errorEnum::invalid_allergies;
        }
        if(strlen($this->trusted_parties) > 50){
            return errorEnum::invalid_trusted_parties;
        }

        for ($i = 0; $i < 7; $i++){
            if ($this->expect_checkout[$i] > -1 && $this->expect_checkin[$i] < 0){
                return errorEnum::checkin_time_missing;
            }
            if ($this->expect_checkin[$i] > -1 && $this->expect_checkout[$i] < 0){
                return errorEnum::checkout_time_missing;
            }
            if ($this->expect_checkin[$i] > $this->expect_checkout[$i]){
                return errorEnum::checkout_less_than_checkin;
            }
        }

        return errorEnum::no_errors;
    }

    /**
     * returns the current status of the child
     * @param null $currentTime gets the current time
     * @return int returns the int of the current status for child
     */
    public function getStatus($currentTime = null){
        if ($currentTime === null){
            $currentTime = dateTimeProvider::getCurrentDateTime();
        }

        $mfm = 60 * $currentTime['hours'] + $currentTime['minutes'];
        $ciStamp = strtotime($this->last_checkin);
        $coStamp = strtotime($this->last_checkout);
        if ($ciStamp > $coStamp){
            //here
            $co_expect = $this->expect_checkout[$currentTime['wday']]+$this->parent_late_minutes;
            if (0 <= $co_expect && $co_expect < $mfm){
                return childStatus::here_due;
            }
            return childStatus::here_ok;
        }
        else{
            //not here
            $ci_expect = $this->expect_checkin[$currentTime['wday']];
            $lastCoStamp = dateTimeProvider::getdate($this->last_checkout);
            $lastcoToday = $lastCoStamp['mon'] === $currentTime['mon']
                && $lastCoStamp['year'] === $currentTime['year'] && $lastCoStamp['mday'] === $currentTime['mday'];
            if ($ci_expect < 0 || $lastcoToday === true){
                return childStatus::not_here_ok;
            }
            if ($ci_expect < $mfm){
                return childStatus::not_here_late;
            }
            return childStatus::not_here_due;
        }
    }

    /**
     * returns the expected checking for that day
     * @param int $dayOfWeek which day of the week you are looking for
     * @param bool $readable returns readable version
     * @return string a readable string of the expected checkin
     */
    public function getExpectedCheckin($dayOfWeek = -1, $readable = true){
        return self::getExpected($this->expect_checkin, $dayOfWeek, $readable);
    }

    /**
     * returns the trusted parties
     * @return string a string of the trusted parties
     */
    public function getTrustedParties(){
        return $this->trusted_parties;
    }

    /**
     * returns the expected checkout for that day
     * @param int $dayOfWeek which day of the week you are looking for
     * @param bool $readable returns readable version
     * @return string a readable string of the expected checkin
     */
    public function getExpectedCheckout($dayOfWeek = -1, $readable = true){
        return self::getExpected($this->expect_checkout, $dayOfWeek, $readable, $this->parent_late_minutes);
    }

    /**
     * helper fucntion for return expected checkout and checkins
     * @param array $arr checkout and checkin times to be returned
     * @param int $dayOfWeek which day
     * @param bool $readable if it will be readable
     * @param int $mins how many min into the day
     * @return string the expected time
     */
    private static function getExpected($arr, $dayOfWeek, $readable, $mins = 0){
        if ($dayOfWeek === -1){
            $dayOfWeek = dateTimeProvider::getCurrentDateTime()['wday'];
        }
        if ($readable === true){
            return self::readable($arr[$dayOfWeek]+$mins);
        }
        return $arr[$dayOfWeek]+$mins;
    }

    /**
     * Returns checkin times in readable array
     * @return array the readable results in an array
     */
   public function expectCheckinReadable(){
       $readable = [];
       for ($i=0; $i<7; $i++){
           $readable[$i] = self::readable($this->expect_checkin[$i]);
       }
       return $readable;
    }
    /**
     * Returns checkout times in readable array
     * @return array the readable results in an array
     */
   public function expectCheckoutReadable(){
       $readable = [];
       for ($i=0; $i<7; $i++){
           $readable[$i] = self::readable($this->expect_checkout[$i]);
       }
       return $readable;
    }

    /**
     * converfts min value to readble value
     * @param $mfm value to be converted to readable
     * @return string
     */
   private static function readable($mfm){
       if ($mfm < 0){
           return '';
       }
       $min = $mfm % 60;
       $hrs = $mfm / 60;
       $ap = ($hrs >= 12) ?'pm' : 'am';
       $hrs %= 12;
       if ($hrs == 0){
           $hrs = 12;
       }
       return sprintf("%02d:%02d %s", $hrs, $min, $ap);
    }

    /**
     * Helper function
     * @param $minutes minutes to be checked
     * @return bool
     */
    public static function checkMinutes($minutes){
        for ($i=0; $i<7; $i++){
            if ($minutes==15*$i){
                return true;
            }
        }
        return false;
    }
}