<?php

use EmzStagingEnvironmentDeluxe\Models\Staging\Staging;

class Shopware_Controllers_Backend_StagingList extends Shopware_Controllers_Backend_Application
{
    protected $model = 'EmzStagingEnvironmentDeluxe\Models\Staging\Staging';
    protected $alias = 'staging';

    public function save($data)
    {
        $staging = new Staging();

        $staging->setName($data['name']);
        $staging->setCreatedOn(date("Y-m-d"));
        $staging->setDbHost($data['dbHost']);
        $staging->setDbPort($data['dbPort']);
        $staging->setDbName($data['dbName']);
        $staging->setDbUser($data['dbUser']);
        $staging->setDbPassword($data['dbPassword']);
        $staging->setExcludedFolders($data['excludedFolders']);
        $staging->setStagingConfig('lol');

        $em = $this->get('models');

        $em->persist($staging);
        $em->flush();
    }
}
