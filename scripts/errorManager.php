<?php

class errorManager {

    private static $errorMessages = array(
        1 => "Invalid Information"
    );

    public static function getErrorMessage($errorId) {

        if (array_key_exists ($errorId, self::$errorMessages)) {
            return self::$errorMessages[$errorId];
        } else { //the error does not exist
            return "";
        }
    }

}