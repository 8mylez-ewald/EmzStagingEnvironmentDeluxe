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

    public function createStagingAction()
    {
        $offset = $this->Request()->getParam('offset');
        $limit = $this->Request()->getParam('limit');

        $mediaPaths = $this->getMediaPaths($offset, $limit);
        $this->get('emz_sed.sync_service')->syncMedia($mediaPaths);

        $this->View()->assign([
            'success' => true,
            'total' => count($mediaPaths)
        ]);

        //@TODO call Service with Data like offset and limit
    }

    private function getMediaPaths($offset, $limit)
    {
        $dbal = $this->get('dbal_connection');
        $builder = $dbal->createQueryBuilder();

        $builder->select(['path'])
            ->from('s_media')
            ->orderBy('id', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        $result = $builder->execute()->fetchAll();

        return $result;
    }

}
