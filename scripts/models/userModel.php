<?php
/**
 * Created by PhpStorm.
 * User: matt
 */

class User
{
    public $id;

    public function __construct($data)
    {
        $this->$id=$data["id"];
    }
}