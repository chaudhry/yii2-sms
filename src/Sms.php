<?php
namespace chaudhry\sms;

use sms\services\IService;
use Yii;
/**
 * Created by PhpStorm.
 * User: ravindra
 * Date: 2/13/19
 * Time: 9:50 PM
 */
class Sms extends \yii\base\Component
{
    private $services = [];

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        if (!$this->services) {
            throw new \ems\common\components\sms\exceptions\InvalidConfigException('Services can\'t be blank.');
        }
    }

    public function setServices(array $services)
    {
        $this->services = $services;
    }

    public function getServices()
    {
        $services = [];
        foreach ($this->services as $id => $service) {
            $services[$id] = $this->getService($id);
        }
        return $services;
    }

    public function getService($id) : IService
    {
        if (!\is_object($this->services[$id])) {
            $this->services[$id] = $this->createService($id, $this->services[$id]);
        }
        return $this->services[$id];
    }


    /**
     * Create a new {@link ServiceInterface} instance.
     *
     * @param string $id     Service ID.
     * @param array  $config Configurations.
     *
     * @return ServiceInterface|\Object Object instance.
     *
     * @throws InvalidConfigException when some service cannot be created
     */
    protected function createService($id, $config) : IService
    {
        $config['id'] = $id;
        return Yii::createObject($config);
    }
}
