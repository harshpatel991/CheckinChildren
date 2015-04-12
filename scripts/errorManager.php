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
        errorEnum::invalid_information => "Invalid Information",
        errorEnum::password_incorrect => "Old Password is Incorrect",
        errorEnum::password_mismatch => "New Password and Confirmation Don't Match",
        errorEnum::invalid_email => "Invalid Email Address",
        errorEnum::invalid_name => "Invalid Name",
        errorEnum::invalid_phone => "Invalid Phone Number (must be 10 digits)",
        errorEnum::invalid_address => "Invalid Address",
        errorEnum::invalid_password => "Invalid Password",
        errorEnum::missing_carrier => "If you want to receive text alerts, you must add a mobile carrier",
        errorEnum::invalid_allergies => "Invalid Allergies",
        errorEnum::invalid_trusted_parties => "Invalid Trusted Parties",
        errorEnum::parent_not_found => "Parent not found in system",
        errorEnum::facility_not_found => "Facility not found in system",
        errorEnum::checkin_time_missing => "Checkin time missing where checkout time set",
        errorEnum::checkout_time_missing=> "Checkout time missing where checking time set",
        errorEnum::checkout_less_than_checkin => "Checkout time earlier than checkin time",
        errorEnum::permission_error => "Permissions Error. You do not have permission to perform this action.",
        errorEnum::permission_view_error => "Permissions Error. You do not have permission to view this page.",
        errorEnum::invalid_authentication => "Invalid Authentication. Pleaase try logging in again.",
        errorEnum::invalid_child => "Invalid Child.",
        errorEnum::invalid_employee => "Invalid Employee.",
    );

    /**
     * Retrieves the plain English form of an errorId
     * @param $errorId int id of the error whose message will be returned
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
    const invalid_information = 1;
    const password_incorrect = 2;
    const password_mismatch = 3;
    const invalid_email = 4;
    const invalid_name = 6;
    const invalid_phone = 8;
    const invalid_address = 10;
    const invalid_password = 12;
    const missing_carrier = 14;
    const invalid_allergies = 16;
    const invalid_trusted_parties = 18;
    const parent_not_found = 20;
    const facility_not_found = 22;
    const checkin_time_missing = 24;
    const checkout_time_missing = 26;
    const checkout_less_than_checkin = 28;
    const permission_error = 30;
    const permission_view_error = 31;
    const invalid_authentication = 32;
    const invalid_child = 33;
    const invalid_employee = 34;
}