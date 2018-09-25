<?php

namespace EmzStagingEnvironmentDeluxe\Subscriber;

use Enlight\Event\SubscriberInterface;

class Controller implements SubscriberInterface
{

    /**
     * @var \Enlight_Template_Manager $templateManager
     */
    private $templateManager;

    /**
     * @param \Enlight_Template_Manager $templateManager
     */
    public function __construct(
        \Enlight_Template_Manager $templateManager
    ) {
        $this->templateManager = $templateManager;
    }

    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Dispatcher_ControllerPath_Frontend_StagingCtrl' => 'onGetControllerPath',
            'Enlight_Controller_Dispatcher_ControllerPath_Backend_StagingList' => 'addStagingListController'
        ];
    }

    public function onGetControllerPath()
    {
        return __DIR__ . '/../Controllers/Frontend/StagingCtrl.php';
    }

    public function addStagingListController()
    {
        $this->templateManager->addTemplateDir(
            __DIR__ . '/../Resources/Views/'
        );

        return __DIR__ . '/../Controllers/Backend/StagingList.php';
    }
}
