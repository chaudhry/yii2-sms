<?php
/**
 * Created by PhpStorm.
 * User: ravindra
 * Date: 2/13/19
 * Time: 10:10 PM
 */

namespace sms\services;


interface IService
{
    public function sendMessage($mobile, $message) : bool;

    public function saveMessage($mobile, $message) : bool;
}
