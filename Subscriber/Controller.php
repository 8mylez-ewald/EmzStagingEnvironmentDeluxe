<?php

namespace EmzStagingEnvironmentDeluxe\Subscriber;

use Enlight\Event\SubscriberInterface;

class Controller implements SubscriberInterface {
    public static function getSubscribedEvents() {
        return [
            'Enlight_Controller_Dispatcher_ControllerPath_Frontend_Staging' => 'onGetControllerPath',
        ];
    }

    public function onGetControllerPath() {
        return __DIR__ . '/../Controllers/Frontend/Staging.php';
    }
}