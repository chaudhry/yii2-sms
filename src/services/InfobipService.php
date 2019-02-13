<?php
/**
 * Created by PhpStorm.
 * User: ravindra
 * Date: 2/14/19
 * Time: 12:42 AM
 */

namespace sms\services;


use yii\httpclient\Client;
use yii\web\HttpException;

class InfobipService extends BaseService
{
    public $username;
    public $password;
    public $from;

    private static $url = 'https://mn8m4.api.infobip.com/sms/2/text/single';

    public function sendMessage($mobile, $message): bool
    {
        try {
            $client = new Client();
            $client->post(self::$url, [
                'from' => $this->from,
                'text' => $message,
                'to' => $mobile,
            ], ["accept: application/json",
                "authorization: Basic " . base64_encode($this->username . ':' . $this->password),
                "content-type: application/json"
            ])->send();
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage, 0, $e);
        }
    }
}
