<?php

namespace EmzStagingEnvironmentDeluxe\Components\ConfigFile;

use Symfony\Component\Filesystem\Filesystem;
use EmzStagingEnvironmentDeluxe\Components\ConfigFile\Configuration;

class ConfigFileService {
    
    private $rootDir;
    private $fileSystem;

    public function __construct($rootDir, Filesystem $fileSystem) {
        $this->rootDir = $rootDir;
        $this->fileSystem = $fileSystem;
    }

    public function createConfigFile(Configuration $configuration) {

        $config = include($this->rootDir.'/config.php');
        
        $configContent = <<<EMZ_CONFIG_FILE_EOD
<?php 
return [
    'db' => [
        'username' => '{$configuration->getDatabaseUsername()}',
        'password' => '{$configuration->getDatabasePassword()}',
        'dbname' => '{$configuration->getDatabaseName()}',
        'host' => '{$configuration->getDatabaseHost()}',
        'port' => '{$configuration->getDatabasePort()}'
    ],
    'front' => [
        'throwExceptions' => true,
        'showException' => true
    ],

    'phpsettings' => [
        'display_errors' => 1
    ],

    'template' => [
        'forceCompile' => true
    ],

    'csrfProtection' => [
        'frontend' => true,
        'backend' => true
    ],

    'httpcache' => [
        'debug' => true
    ]
];
EMZ_CONFIG_FILE_EOD;

        $this->fileSystem->dumpFile(
            $this->rootDir.'/'.$configuration->getSubFolder().'/config.php', 
            $configContent
        );

        return true;
    }
}