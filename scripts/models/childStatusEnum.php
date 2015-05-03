<?php

/**
 * Class childStatus
 *
 * Enum to describe the current status of a child.
 */
class childStatus
{
    /**
     * Child here, parent is late.
     */
    const here_due = 0;

    /**
     * Child here, expected to be.
     */
    const here_ok = 1;

    /**
     * Child not here, considered late.
     */
    const not_here_late = 2;

    /**
     * Child not here, expected to arrive later.
     */
    const not_here_due = 3;

    /**
     * Child not here, not expected to be here now.
     */
    const not_here_ok = 4;


    /**
     * Message indicating parent is late.
     */
    const info_here_due = "PARENT IS LATE!";

    /**
     * Message indicating a child is checked in, expecting parent.
     */
    const info_here_ok = "CHECKED IN. EXPECTING PARENT.";

    /**
     * Message indicating the child is late.
     */
    const info_not_here_late = "LATE!";

    /**
     * Message indicating the child will arrive later.
     */
    const info_not_here_due = "ARRIVING.";

    /**
     * Message indicating the child is not expected now.
     */
    const info_not_here_ok = "NOT COMING TODAY.";

    /**
     * Get the message string from the child status enum.
     *
     * @param int $status The status enum of the child.
     * @return string The info description string.
     */
    public static function getInfo($status = 0){
        switch ($status) {
            case self::here_due:
                return self::info_here_due;
            case self::here_ok:
                return self::info_here_ok;
            case self::not_here_late:
                return self::info_not_here_late;
            case self::not_here_due:
                return self::info_not_here_due;
            case self::not_here_ok:
                return self::info_not_here_ok;
        }
    }
}

/**
 * Class messageStatus
 *
 * Current status of the messages sent from the child.
 */
class messageStatus{
    const child_late = 0;
    const child_checked_in = 1;
    const child_ready = 2;
    const child_checked_out = 3;
}