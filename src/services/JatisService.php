<?php
/**
 * Created by PhpStorm.
 * User: ravindra
 * Date: 2/13/19
 * Time: 10:00 PM
 */

namespace ems\common\components\sms\services;


use yii\httpclient\Client;
use yii\web\HttpException;

class JatisService extends BaseService
{
    public $username;
    public $password;
    public $sender;
    public $batchName;

    private static $url = 'https://sms-api.jatismobile.com/index.ashx';

    public function sendMessage($mobile, $message): bool
    {
        try {
            $client = new Client();
            $response = $client->post(self::$url, [
                'userid' => $this->username,
                'password' => $this->password,
                'sender' => $this->sender,
                'msisdn' => $mobile,
                'message' => $message,
                'division' => 'AT2',
                'batchname' => $this->batchName,
                'uploadby' => $this->batchName,
                'channel' => 2
            ])->send();
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage, 0, $e);
        }
    }
}