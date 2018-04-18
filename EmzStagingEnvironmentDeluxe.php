<?php

namespace EmzStagingEnvironmentDeluxe;

use Shopware\Components\Plugin;
use Symfony\Component\DependencyInjection\ContainerBuilder;

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
        $container->setParameter('emz_staging_environment_deluxe.plugin_dir', $this->getPath());
        parent::build($container);
    }

}
