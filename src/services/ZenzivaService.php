<?php
/**
 * Created by PhpStorm.
 * User: ravindra
 * Date: 2/14/19
 * Time: 12:33 AM
 */

namespace ems\common\components\sms\services;


use yii\web\HttpException;

class ZenzivaService extends BaseService
{
    public $username;
    public $password;

    private static $url = 'https://reguler.zenziva.net/apps/smsapi.php';

    public function sendMessage($mobile, $message): bool
    {
        try {
            $client = new Client();
            $client->post(self::$url, [
                'userkey' => 'ototestuser',
                'passkey' => 'otouser123',
                'nohp' => $mobile,
                'pesan' => urlencode($message)
            ])->send();
        } catch (\Exception $e) {
            throw new HttpException(500, $e->getMessage, 0, $e);
        }
    }
}