<?php

namespace EmzStagingEnvironmentDeluxe\Components;

use Shopware\Components\Model\ModelManager;
use Shopware\Models\Plugin\Plugin;
use Doctrine\DBAL\Connection;
use Symfony\Component\Filesystem\Filesystem;
use Shopware\Components\Install\Database;

class SyncService {

    private $modelManager;
    private $connection;
    private $fileSystem;
    private $rootDir;

    public function __construct($rootDir, ModelManager $modelManager, Connection $connection, Filesystem $fileSystem) {
        $this->rootDir = $rootDir;
        $this->modelManager = $modelManager;
        $this->connection = $connection;
        $this->fileSystem = $fileSystem;
    }

    public function syncCore($subFolder = 'staging') {

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
                $this->fileSystem->mirror($this->rootDir.'/'.$folder, $this->rootDir.'/'.$subFolder.'/'.$folder);
            }
        }

        foreach($foldersToCreate as $folder) {
            if(!$this->fileSystem->exists($this->rootDir.'/'.$subFolder.'/'.$folder)) {
                $this->fileSystem->mkdir($this->rootDir.'/'.$subFolder.'/'.$folder);
            }
        }

        foreach($filesToCopy as $file) {
            if($this->fileSystem->exists($file)) {
                $this->fileSystem->copy($this->rootDir.'/'.$file, $this->rootDir.'/'.$subFolder.'/'.$file);
            }
        }

        return true;
    }

    public function syncMedia($mediaPaths, $subFolder = 'staging') {

        $mediaService = Shopware()->Container()->get('shopware_media.media_service');

        foreach($mediaPaths as $path){
            $path['path'] = $mediaService->encode($path['path']);
            // if(!$this->fileSystem->exists($this->rootDir.'/'.$subFolder.'/'.$path['path'])) {
                $this->fileSystem->copy($this->rootDir.'/'.$path['path'], $this->rootDir.'/'.$subFolder.'/'.$path['path']);
            // }
        }



        //maybe select wich albums should be copied?
        //get albums
        // $builder = Shopware()->Models()->createQueryBuilder();
        // $albumId = $this->Request()->getParam('albumId', null);
        //
        // $builder->select(['album'])
        //     ->from('Shopware\Models\Media\Album', 'album')
        //     ->where('album.parentId IS NULL')
        //     ->orderBy('album.position', 'ASC');
        //
        // if (!empty($albumId)) {
        //     if (strpos($albumId, ',') !== false) {
        //         $albumId = explode(',', $albumId);
        //     } else {
        //         $albumId = [$albumId];
        //     }
        //     $builder->andWhere('album.id IN(:albumId)')
        //         ->setParameter('albumId', $albumId);
        // }
        //
        // $albums = $builder->getQuery()->getResult();
        // $albums = $this->toTree($albums);
        // $filter = $this->Request()->albumFilter;
        //
        // if (!empty($filter)) {
        //     $albums = $this->filterAlbums($albums, $filter);
        // }

        //$this->View()->assign(['success' => true, 'data' => $albums, 'total' => count($albums)]);
    }

    public function syncFiles() {
        //the files that are created from shopware, e.g. invoices
    }
}
