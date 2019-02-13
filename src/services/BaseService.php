<?php
/**
 * Created by PhpStorm.
 * User: ravindra
 * Date: 2/13/19
 * Time: 11:15 PM
 */

namespace sms\services;
use Yii;

abstract class BaseService implements IService
{
    public $useFileTransport;

    /**
     * @var string the directory where the email messages are saved when [[useFileTransport]] is true.
     */
    public $fileTransportPath = '@runtime/mail';

    public function send($mobile, $message): bool
    {
        return $this->useFileTransport ? $this->saveMessage($mobile, $message) : $this->sendMessage($mobile, $message);
    }

    public function saveMessage($mobile, $message): bool
    {
        $path = Yii::getAlias($this->fileTransportPath);
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $file = $path . '/' . $mobile . '-' . $this->generateMessageFileName();

        file_put_contents($file, $message);

        return true;
    }

    /**
     * @return string the file name for saving the message when [[useFileTransport]] is true.
     */
    public function generateMessageFileName()
    {
        $time = microtime(true);

        return date('Ymd-His-', $time) . sprintf('%04d', (int) (($time - (int) $time) * 10000)) . '-' . sprintf('%04d', mt_rand(0, 10000)) . '.sms';
    }
}
