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
    
    public function getTotalImagesAction()
    {
        $totalCount = (int)$this->getTotalMedia();

        $this->View()->assign([
            'success' => true,
            'totalCount' => $totalCount
        ]);
    }

    public function createStagingAction()
    {
        $offset = $this->Request()->getParam('offset');
        $limit = $this->Request()->getParam('limit');

        $mediaPaths = $this->getMediaPaths($offset, $limit);
        $this->get('emz_sed.sync_service')->syncMedia($mediaPaths);

        if(!empty($mediaPaths)){
            $this->View()->assign([
                'success' => true,
                'total' => count($mediaPaths)
            ]);
        }else{
            $this->View()->assign([
                'success' => false,
                'failure' => true
            ]);
        }

        //@TODO call Service with Data like offset and limit
    }

    public function getAlbumsAction()
    {
        $albums = $this->getAllAlbums();

        $this->View()->assign([
            'success' => true,
            'albums' => $albums
        ]);
    }

    private function getTotalMedia()
    {
        $dbal = $this->get('dbal_connection');
        $builder = $dbal->createQueryBuilder();

        $builder->select('count(id)')
            ->from('s_media');

        $result = $builder->execute()->fetchAll(\PDO::FETCH_COLUMN);
        return $result[0];
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

    private function getAllAlbums()
    {
        $dbal = $this->get('dbal_connection');
        $builder = $dbal->createQueryBuilder();

        $builder->select(['a.id, count(DISTINCT m.id) as amount'])
            ->from('s_media_album', 'a')
            ->innerJoin('a', 's_media', 'm', 'm.albumID = a.id')
            ->groupBy(1);

        $result = $builder->execute()->fetchAll();
        return $result;
    }
}
