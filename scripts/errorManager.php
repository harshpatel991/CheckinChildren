<?php

/**
 * Class errorManager Defines and allows retrieval of error messages displayed through out the application
 */
class errorManager {

    /**
     * @var array Mapping from error codes to error messages
     * To add a new error message, add key-value pair below and redirect appropriate page to ?error=key
     */
    private static $errorMessages = array(
        1 => "Invalid Information",
        2 => "Old Password is Incorrect",
        3 => "New Password and Confirmation Don't Match",
        4 => "Invalid Email Address",
        6 => "Invalid Name",
        8 => "Invalid Phone Number (must be 10 digits)",
        10 => "Invalid Address",
        12 => "Invalid Passowrd",
        14 => "If you want to receive text alerts, you must add a mobile carrier",
    );

    /**
     * Retrieves the plain English form of an errorId
     * @param $errorId The id of the error whose message will be returned
     * @return string The plain English form of the error
     */
    public static function getErrorMessage($errorId) {

        if (array_key_exists ($errorId, self::$errorMessages)) {
            return self::$errorMessages[$errorId];
        } else { //the error does not exist
            return "";
        }
    }
}

class errorEnum {
    const no_errors = 0;
    const invalid_email = 4;
    const invalid_name = 6;
    const invalid_phone = 8;
    const invalid_address = 10;
    const invalid_password = 12;
    const missing_carrier = 14;
}