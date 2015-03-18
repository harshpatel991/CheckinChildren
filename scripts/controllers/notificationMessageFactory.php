<?php
/**
 * Created by PhpStorm.
 * User: matt
 * Date: 3/16/15
 * Time: 6:41 PM
 */
require_once(dirname(__FILE__).'/notificationMessageController.php');

/**
 * Class notificationMessageFactory
 *
 * Factory to construct a notificationMessageController using a child object and messageStatus.
 * Using factory pattern here primarily for dependency injection and testability.
 */
class notificationMessageFactory{

    /**
     * Creates a notificationMessageController object with a child object and message status.
     *
     * @param $child childModel used to construct controller.
     * @param $messageStatus messageStatus used to construct controller.
     * @param null $emailer messageAdapter used to construct controller, only used for dependency injection.
     * @return notificationMessageController the controller.
     */
    public function create($child, $messageStatus, $emailer = null){
        if ($emailer === null){
            $emailer = new messageAdapter();
        }

        return new notificationMessageController($child, $messageStatus, $emailer);
    }
}