<?php

class dateTimeProvider
{
    public static function getCurrentDateTime(){
        date_default_timezone_set('America/Chicago');
        if (isset($_SESSION['test_timestamp'])){
            return getdate($_SESSION['test_timestamp']);
        }
        return getdate();
    }

    /*
     * dateTime must be in format mm/dd/YYYY hh:mm
     */
    public static function setTestDateTime($dateTime){
        session_start();
        date_default_timezone_set('America/Chicago');
        $timestamp = strtotime($dateTime);
        $_SESSION['test_timestamp'] = $timestamp;
    }
}