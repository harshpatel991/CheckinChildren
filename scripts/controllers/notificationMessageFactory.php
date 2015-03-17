<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 3/16/15
 * Time: 6:41 PM
 */
require_once(dirname(__FILE__).'/notificationMessageController.php');

class notificationMessageFactory{
    public function create($child, $messageStatus, $emailer = null){
        return new notificationMessageController($child, $messageStatus, $emailer);
    }
}