<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 3/4/15
 * Time: 1:23 PM
 */

class childStatus
{
    const here_due = 0; //here, parent is late
    const here_ok = 1;  //here, should be
    const not_here_late = 2; //not here, late
    const not_here_due = 3;  //not here, will arrive later
    const not_here_ok = 4;   //not here, not coming
}

class messageStatus{
    const child_late = 0;
    const child_checked_in = 1;
    const child_ready = 2;
    const child_checked_out = 3;
}