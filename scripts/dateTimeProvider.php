<?php
require_once(dirname(__FILE__).'/../config.php');

/**
 * Class dateTimeProvider
 *
 * Contains static functions for interacting with datetimes.
 * Responsible for getting current system time (or test time if applicable), and converting between formats and timezones.
 */
class dateTimeProvider
{
    /**
     * Gets the current system datetime, or the test datetime if applicable. Adjusted to Central Time Zone.
     *
     * @return array The current system datetime, formatted as standard PHP datetime array.
     */
    public static function getCurrentDateTime(){
        date_default_timezone_set('America/Chicago');
        if (false===isset($_SESSION['test_tick'])){
            $_SESSION['test_tick'] = 0;
        }
        if (isset($_SESSION['test_timestamp'])){
            return getdate($_SESSION['test_timestamp'] + $_SESSION['test_tick']);
        }

        return getdate();
    }

    /**
     * Gets a PHP datetime array from a datetime string.
     *
     * @param string $str The datetime string.
     * @return array The datetime, formatted as standard PHP datetime array.
     */
    public static function getdate($str){
        date_default_timezone_set('America/Chicago');
        return getdate(strtotime($str));
    }

    /**
     * Sets the test time by a datetime string.
     *
     * @param string $dateTime The datetime string, must be in format mm/dd/YYYY hh:mm.
     */
    public static function setTestDateTime($dateTime){
        date_default_timezone_set('America/Chicago');
        $timestamp = strtotime($dateTime);
        $_SESSION['test_timestamp'] = $timestamp;
    }

    /**
     * Increments the test time by speceified number of millis.
     *
     * @param int $millis Number of milliseconds to increment.
     */
    public static function testTimeTick($millis=1){
        if (!isset($_SESSION['test_tick'])){
            $_SESSION['test_tick'] = 0;
        }
        $_SESSION['test_tick'] += $millis;
    }

    /**
     * Removes the current test timestamp, only used for testing.
     */
    public static function unsetTestDateTime(){
        unset($_SESSION['test_timestamp']);
    }

    /**
     * Gets a standard PHP datetime array from a timestamp.
     *
     * @param int $timestamp The timestamp in millis.
     * @return array The datetime array, standard PHP datetime format.
     */
    public function getDateTimeFromStamp($timestamp){
        date_default_timezone_set('America/Chicago');
        return getdate($timestamp);
    }

    /**
     * Gets a readable time string from the current datetime, or from option parameter datetime.
     *
     * @param array $time The datetime to use, formatted in standard PHP datetime array.
     * @param bool $includeSeconds Whether to include seconds in the string.
     * @return string The readable string.
     */
    public static function readableTime($time = null, $includeSeconds = true){
        if ($time === null){
            $time = self::getCurrentDateTime();
        }

        $hrs = $time['hours'];
        $ap = 'am';
        if ($hrs > 12){
            $hrs -= 12;
            $ap = 'pm';
        }

        if ($includeSeconds==true) {
            return sprintf('%02d:%02d:%02d %s', $hrs, $time['minutes'], $time['seconds'], $ap);
        }
        return sprintf('%02d:%02d %s', $hrs, $time['minutes'], $ap);
    }

    /**
     * Gets a readable date string from the current datetime, or from option parameter datetime.
     *
     * @param array $time The datetime to use, formatted in standard PHP datetime array.
     * @return string The readable string.
     */
    public static function readableDate($time = null){
        if ($time === null){
            $time = self::getCurrentDateTime();
        }

        return sprintf('%02d/%02d/%02d', $time['mon'], $time['mday'], $time['year']);
    }

    /**
     * Determines the number of minutes from last midnight of a given time of day.
     *
     * @param string $time The time in the format 'HH:MM am/pm'.
     * @return int The minutes from midnight.
     */
    public static function minutesFromMidnight($time){
        if(!isset($time) || $time==='' || $time==null) {
            return -1;
        }
        $hmap = preg_split("/[\s:]+/", $time);
        $hmap[0] %= 12;
        if ($hmap[2] === 'pm'){
            $hmap[0] += 12;
        }
        return $hmap[1] + $hmap[0] * 60;
    }

    /**
     * Converts a time in minutes-from-midnight format to a readable string.
     *
     * @param int $minutesFromMidnight The number of minutes away from last midnight.
     * @return string The readable time.
     */
    public static function readableTimeOfDay($minutesFromMidnight){
        $readable = sprintf("%02d", $minutesFromMidnight / 60);
        $readable .= ':'.sprintf("%02d", $minutesFromMidnight % 60);
        return $readable;
    }
}
session_start();
if (isset(Config::$config['test_time'])){
    dateTimeProvider::setTestDateTime(Config::$config['test_time']);
}