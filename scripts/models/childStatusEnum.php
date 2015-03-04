<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 3/4/15
 * Time: 1:23 PM
 */

class childStatus
{
    const here_due = 1; //here, parent is late
    const here_ok = 2;  //here, should be
    const not_here_late = 3; //not here, late
    const not_here_due = 4;  //not here, will arrive later
    const not_here_ok = 5;   //not here, not coming
}