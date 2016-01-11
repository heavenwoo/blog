<?php

namespace Taichi\CarbonBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('taichi_carbon');


        $rootNode
            ->children()
                ->scalarNode('locale')->defaultValue('en')->end()
                ->scalarNode('format')->defaultValue('Y-m-d H:i')->end()
                ->booleanNode('diffforhumans')->defaultTrue()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
