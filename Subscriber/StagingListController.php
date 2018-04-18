<?php

namespace EmzStagingEnvironmentDeluxe\Subscriber;

use Enlight\Event\SubscriberInterface;

class StagingListController implements SubscriberInterface
{
    /**
     * @var string
     */
    private $pluginDir;

    /**
     * @var \Enlight_Template_Manager $templateManager
     */
    private $templateManager;

    /**
     * @param string $pluginDir
     * @param \Enlight_Template_Manager $templateManager
     */
    public function __construct(
        $pluginDir,
        \Enlight_Template_Manager $templateManager
    )
    {
        $this->pluginDir = $pluginDir;
        $this->templateManager = $templateManager;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            'Enlight_Controller_Dispatcher_ControllerPath_Backend_StagingList' => 'addStagingListController'
        );
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     *
     * @return string
     */
    public function addStagingListController(\Enlight_Event_EventArgs $args)
    {
        $this->templateManager->addTemplateDir(
            $this->pluginDir . '/Resources/Views/'
        );

        return $this->pluginDir . '/Controllers/Backend/StagingList.php';

    }
}
