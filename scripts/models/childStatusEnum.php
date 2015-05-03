<?php

class childStatus
{
    const here_due = 0; //here, parent is late
    const here_ok = 1;  //here, should be
    const not_here_late = 2; //not here, late
    const not_here_due = 3;  //not here, will arrive later
    const not_here_ok = 4;   //not here, not coming

    const info_here_due = "PARENT IS LATE!"; //here, parent is late
    const info_here_ok = "CHECKED IN. EXPECTING PARENT.";  //here, should be
    const info_not_here_late = "LATE!"; //not here, late
    const info_not_here_due = "ARRIVING.";  //not here, will arrive later
    const info_not_here_ok = "NOT COMING TODAY.";   //not here, not coming

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

class messageStatus{
    const child_late = 0;
    const child_checked_in = 1;
    const child_ready = 2;
    const child_checked_out = 3;
}