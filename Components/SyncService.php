<?php

namespace EmzStagingEnvironmentDeluxe\Components;

use Shopware\Components\Model\ModelManager;
use Shopware\Models\Plugin\Plugin;
use Doctrine\DBAL\Connection;
use Shopware\Components\Plugin\ConfigReader;
use Symfony\Component\Filesystem\Filesystem;

class SyncService {

    private $modelManager;
    private $connection;
    private $configReader;
    private $fileSystem;
    private $rootDir;

    public function __construct($rootDir, ModelManager $modelManager, Connection $connection, Filesystem $fileSystem) {
        $this->rootDir = $rootDir;
        $this->modelManager = $modelManager;
        $this->connection = $connection;
        $this->fileSystem = $fileSystem;
        $this->docPath = Shopware()->DocPath();
    }

    public function syncCore() {
        $subfolder = 'staging';

        $folders = [
            'bin',
            'custom',
            'engine',
            'files',
            'recovery',
            'vendor'
        ];

        foreach($folders as $folder) {
            if($this->fileSystem->exists($this->rootDir.'/'.$folder)){
                $this->fileSystem->mirror($this->rootDir.'/'.$folder, $this->rootDir.'/'.$subfolder.'/'.$folder);
            }
        }
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
    

    public function syncMedia() {

    }
}