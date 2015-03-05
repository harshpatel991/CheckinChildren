<?php
require(dirname(__FILE__).'/../config.php');
class dateTimeProvider
{
    public static function getCurrentDateTime(){
        date_default_timezone_set('America/Chicago');
        if (isset($_SESSION['test_timestamp'])){
            return getdate($_SESSION['test_timestamp']);
        }

        return getdate();
    }

    public static function getdate($str){
        date_default_timezone_set('America/Chicago');
        return getdate(strtotime($str));
    }

    /*
     * dateTime must be in format mm/dd/YYYY hh:mm
     */
    public static function setTestDateTime($dateTime){
        date_default_timezone_set('America/Chicago');
        $timestamp = strtotime($dateTime);
        $_SESSION['test_timestamp'] = $timestamp;
    }

    public static function unsetTestDateTime(){
        unset($_SESSION['test_timestamp']);
    }

    public function getDateTimeFromStamp($timestamp){
        date_default_timezone_set('America/Chicago');
        return getdate($timestamp);
    }

    public static function readableTimeOfDay($minutesFromMidnight){
        $readable = sprintf("%02d", $minutesFromMidnight / 60);
        $readable .= ':'.sprintf("%02d", $minutesFromMidnight % 60);
        return $readable;
    }
}

if (isset($config['test_time'])){
    dateTimeProvider::setTestDateTime($config['test_time']);
}