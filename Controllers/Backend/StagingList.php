<?php

use EmzStagingEnvironmentDeluxe\Models\Staging\Staging;

class Shopware_Controllers_Backend_StagingList extends Shopware_Controllers_Backend_Application
{
    protected $model = 'EmzStagingEnvironmentDeluxe\Models\Staging\Staging';
    protected $alias = 'staging';

    public function save($data)
    {
        $staging = new Staging();

        $staging->fromArray($data);
        $staging->setCreatedOn(date("Y-m-d"));

        $em = $this->get('models');

        $em->persist($staging);
        $em->flush();
    }

    public function createStaging()
    {
        //@TODO call Service with Data like offset and limit
    }
}
