<?php

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
     * @param childModel $child The child used to construct controller.
     * @param messageStatus $messageStatus The status used to construct controller.
     * @param messageAdapter $emailer The adapter used to construct controller, only used for dependency injection.
     * @return notificationMessageController The controller.
     */
    public function create($child, $messageStatus, $emailer = null){
        if ($emailer === null){
            $emailer = new messageAdapter();
        }

        return new notificationMessageController($child, $messageStatus, $emailer);
    }
}