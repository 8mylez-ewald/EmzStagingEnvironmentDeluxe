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
    }

    public function syncCore() {
        $subfolder = 'staging';

        $foldersTopCopy = [
            'bin',
            'custom',
            'engine',
            'recovery',
            'vendor',
            'themes'
        ];

        $filesToCopy = [
            '.htaccess',
            'autoload.php',
            'composer.json',
            'composer.lock',
            'config.php',
            'eula.txt',
            'eula_en.txt',
            'license.txt',
            'shopware.php'
        ];

        $foldersToCreate = [
            'var',
            'var/cache',
            'var/log',
            'web',
            'web/cache'
        ];

        $foldersToIgnore = [
            $subfolder
        ];

        foreach($foldersTopCopy as $folder) {
            if($this->fileSystem->exists($this->rootDir.'/'.$folder)) {
                $this->fileSystem->mirror($this->rootDir.'/'.$folder, $this->rootDir.'/'.$subfolder.'/'.$folder);
            }
        }

        foreach($foldersToCreate as $folder) {
            if(!$this->fileSystem->exists($this->rootDir.'/'.$subfolder.'/'.$folder)) {
                $this->fileSystem->mkdir($this->rootDir.'/'.$subfolder.'/'.$folder);
            }
        }

        foreach($filesToCopy as $file) {
            if($this->fileSystem->exists($file)) {
                $this->fileSystem->copy($this->rootDir.'/'.$file, $this->rootDir.'/'.$subfolder.'/'.$file);
            }
        }
    }

    public function syncMedia() {
        
    }

    public function syncFiles() {

    }
}