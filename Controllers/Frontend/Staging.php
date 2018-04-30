<?php

class Shopware_Controllers_Frontend_Staging extends Enlight_Controller_Action
{
    public function indexAction() {
        $this->get('emz_sed.sync_service')->syncPlugins();
    }

    public function themeAction() {
        $this->get('emz_sed.sync_service')->syncThemes();
    }

    public function coreAction() {
        $this->get('emz_sed.sync_service')->syncCore();
    }
}