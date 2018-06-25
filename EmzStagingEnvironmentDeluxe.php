<?php

namespace EmzStagingEnvironmentDeluxe;

use Shopware\Components\Plugin;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use EmzStagingEnvironmentDeluxe\Models\Staging\Staging;
use Doctrine\ORM\Tools\SchemaTool;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UninstallContext;

/**
 * Shopware-Plugin EmzStagingEnvironmentDeluxe.
 */
class EmzStagingEnvironmentDeluxe extends Plugin
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $container->setParameter('emz_sed.plugin_dir', $this->getPath());
        parent::build($container);
    }

    public function install(InstallContext $install)
    {
        $entityManager = $this->container->get('models');
        $tool = new SchemaTool($entityManager);

        $classMetaData = [
            $entityManager->getClassMetadata(Staging::class)
        ];

        $tool->createSchema($classMetaData);
    }

    public function uninstall(UninstallContext $uninstall)
    {
        $entityManager = $this->container->get('models');
        $tool = new SchemaTool($entityManager);

        $classMetaData = [
            $entityManager->getClassMetadata(Staging::class)
        ];

        $tool->dropSchema($classMetaData);
    }
}
