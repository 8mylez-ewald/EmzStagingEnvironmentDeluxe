<?php

namespace EmzStagingEnvironmentDeluxe\Components;

use Shopware\Components\Model\ModelManager;
use Shopware\Models\Plugin\Plugin;
use Doctrine\DBAL\Connection;

class SyncService {

    private $modelManager;
    private $connection;

    public function __construct(ModelManager $modelManager, Connection $connection) {
        $this->modelManager = $modelManager;
        $this->connection = $connection;
    }

    public function syncPlugins() {
        $pluginModel = $this->modelManager->getRepository(Plugin::class);
        $plugins = $pluginModel->findAll();

        foreach($plugins as $plugin) {
            echo "<pre>\n";
            print_r($plugin->getName());
            echo "</pre>\n";
        }

        die();

    }

    public function syncThemes() {
        $builder = $this->connection->createQueryBuilder();
        $builder->select('id, template, name, description, author, license')
                ->from('s_core_templates');
        $stmt = $builder->execute();
        $themes = $stmt->fetchAll();

        foreach($themes as $theme) {
            echo "<pre>\n";
            print_r($theme);
            echo "</pre>\n";
        }

        die();
    }

    public function syncCore() {

    }

    public function syncMedia() {

    }
}