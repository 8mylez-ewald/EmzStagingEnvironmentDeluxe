<?php

namespace EmzStagingEnvironmentDeluxe\Components;

use Shopware\Components\Model\ModelManager;
use Shopware\Models\Plugin\Plugin;
use Doctrine\DBAL\Connection;
use Shopware\Components\Plugin\ConfigReader;
use Symfony\Component\Filesystem\Filesystem;
use Shopware\Components\Install\Database;

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

        //should be configuration
        $this->subFolder = 'staging';
        $this->stagingDatabaseName = 'stagingDatabaseName';
        $this->stagingDatabaseUsername = 'stagingDatabaseUsername';
        $this->stagingDatabasePassword = 'stagingDatabasePassword';
        $this->stagingHost = 'db_emz';
        $this->stagingPort = '3306';
    }

    public function syncCore() {

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

        foreach($foldersTopCopy as $folder) {
            if($this->fileSystem->exists($this->rootDir.'/'.$folder)) {
                $this->fileSystem->mirror($this->rootDir.'/'.$folder, $this->rootDir.'/'.$this->subFolder.'/'.$folder);
            }
        }

        foreach($foldersToCreate as $folder) {
            if(!$this->fileSystem->exists($this->rootDir.'/'.$this->subFolder.'/'.$folder)) {
                $this->fileSystem->mkdir($this->rootDir.'/'.$this->subFolder.'/'.$folder);
            }
        }

        foreach($filesToCopy as $file) {
            if($this->fileSystem->exists($file)) {
                $this->fileSystem->copy($this->rootDir.'/'.$file, $this->rootDir.'/'.$this->subFolder.'/'.$file);
            }
        }

        $this->createConfigFile();
    }

    public function createConfigFile() {
        $config = include($this->rootDir.'/config.php');
        
        $configContent = <<<EMZ_EOD
<?php 
return [
    'db' => [
        'username' => '$this->stagingDatabaseUsername',
        'password' => '$this->stagingDatabasePassword',
        'dbname' => '$this->stagingDatabaseName',
        'host' => '$this->stagingHost',
        'port' => '$this->stagingPort'
    ]
];
EMZ_EOD;

        $this->fileSystem->dumpFile($this->rootDir.'/'.$this->subFolder.'/config.php', $configContent);
    }
    
    public function migrateDatabase() {
        //migrate the database
        //database->createDatabase
        //database->importFile
        //
    }

    public function syncMedia() {

        //maybe select wich albums should be copied?
        //get albums
        $builder = Shopware()->Models()->createQueryBuilder();
        $albumId = $this->Request()->getParam('albumId', null);

        $builder->select(['album'])
            ->from('Shopware\Models\Media\Album', 'album')
            ->where('album.parentId IS NULL')
            ->orderBy('album.position', 'ASC');

        if (!empty($albumId)) {
            if (strpos($albumId, ',') !== false) {
                $albumId = explode(',', $albumId);
            } else {
                $albumId = [$albumId];
            }
            $builder->andWhere('album.id IN(:albumId)')
                ->setParameter('albumId', $albumId);
        }

        $albums = $builder->getQuery()->getResult();
        $albums = $this->toTree($albums);
        $filter = $this->Request()->albumFilter;
        
        if (!empty($filter)) {
            $albums = $this->filterAlbums($albums, $filter);
        }

        //$this->View()->assign(['success' => true, 'data' => $albums, 'total' => count($albums)]); 
    }

    public function syncFiles() {

    }
}