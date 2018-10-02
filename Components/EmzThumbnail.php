<?php

namespace EmzStagingEnvironmentDeluxe\Components;

use Doctrine\DBAL\Connection;
use Shopware\Components\Model\ModelManager;
use Shopware\Components\Thumbnail\Manager;

class EmzThumbnail
{
    private $connection;
    private $modelManager;

    public function __construct(
        Connection $connection,
        ModelManager $modelManager,
        Manager $thumbnailManager
    ) {
        $this->connection = $connection;
        $this->modelManager = $modelManager;
        $this->thumbnailManager = $thumbnailManager;
    }

    public function createThumbnails($params)
    {
        $medias = $this->getMediaForAlbumId($params['albumId'], $params['offset'], $params['limit']);

        $settings = $this->getAlbumSettings($params['albumId']);
        $thumbnailSizes = $settings->getThumbnailSize();

        if (empty($thumbnailSizes) || empty($thumbnailSizes[0])) {
            // $this->View()->assign(['success' => false]);

            return;
        }

        /** @var $manager Shopware\Components\Thumbnail\Manager * */
        $manager = $this->thumbnailManager;

        $fails = [];
        foreach ($medias as $media) {
            try {
                $manager->createMediaThumbnail($media, $thumbnailSizes, true);
            } catch (Exception $e) {
                $fails[] = $e->getMessage();
            }
        }

        $return['medias'] = $medias;
        $return['thumbnailSizes'] = $thumbnailSizes;
        $return['fails'] = $fails;

        return $return;
    }

    /**
     * @param int $albumId
     * @param int $offset
     * @param int $limit
     *
     * @return Media[]
     */
    private function getMediaForAlbumId($albumId, $offset, $limit)
    {
        $builder = $this->modelManager->createQueryBuilder();

        $builder
            ->select(['media'])
            ->from(\Shopware\Models\Media\Media::class, 'media')
            ->where('media.albumId = :albumId')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->setParameter('albumId', $albumId);

        return $builder->getQuery()->getResult();
    }

    /**
     * @param int $albumId
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * @return Settings
     */
    private function getAlbumSettings($albumId)
    {
        $builder = $this->modelManager->createQueryBuilder();

        $builder
            ->select(['settings'])
            ->from(\Shopware\Models\Media\Settings::class, 'settings')
            ->where('settings.albumId = :albumId')
            ->setParameter('albumId', $albumId);

        return $builder->getQuery()->getOneOrNullResult();
    }

}
