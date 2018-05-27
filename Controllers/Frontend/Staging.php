<?php

use EmzStagingEnvironmentDeluxe\Components\ConfigFile\Configuration;

class Shopware_Controllers_Frontend_Staging extends Enlight_Controller_Action
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
}