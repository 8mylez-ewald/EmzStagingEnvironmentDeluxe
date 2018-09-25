<?php

use EmzStagingEnvironmentDeluxe\Components\ConfigFile\Configuration;

class Shopware_Controllers_Frontend_StagingCtrl extends Enlight_Controller_Action
{
    public function indexAction() {
        $this->get('emz_sed.sync_service')->syncPlugins();
    }

    public function coreAction() {
        $resultCore = $this->get('emz_sed.sync_service')->syncCore();

        echo "Result of Core Sync:\n";
        echo "<pre>";
        print_r($resultCore);
        echo "</pre>";

        die();
    }

    public function copyConfigAction() {
        $configuration = new Configuration();
        $resultConfig = $this->get('emz_sed.config_file_service')->createConfigFile($configuration);

        echo "Result of Config Copy:\n";
        echo "<pre>";
        print_r($resultConfig);
        echo "</pre>";

        die();
    }

    public function migrateDatabase() {

    }

    public function createThumbnailAction(){
        $params['offset'] = $this->Request()->getParam('offset');
        $params['limit'] = $this->Request()->getParam('limit');
        $params['albumId'] = $this->Request()->getParam('albumId');

        $thumbnailsCreation = $this->get('emz_sed.emz_thumbnail')->createThumbnails($params);

        $this->View()->assign(['success' => true, 'total' => count($thumbnailsCreation['medias']) * count($thumbnailsCreation['thumbnailSizes']), 'fails' => $thumbnailsCreation['fails']]);
    }
}
