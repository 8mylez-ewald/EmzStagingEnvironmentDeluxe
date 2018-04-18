<?php

namespace EmzStagingEnvironmentDeluxe\Tests;

use EmzStagingEnvironmentDeluxe\EmzStagingEnvironmentDeluxe as Plugin;
use Shopware\Components\Test\Plugin\TestCase;

class PluginTest extends TestCase
{
    protected static $ensureLoadedPlugins = [
        'EmzStagingEnvironmentDeluxe' => []
    ];

    public function testCanCreateInstance()
    {
        /** @var Plugin $plugin */
        $plugin = Shopware()->Container()->get('kernel')->getPlugins()['EmzStagingEnvironmentDeluxe'];

        $this->assertInstanceOf(Plugin::class, $plugin);
    }
}
