<?php

namespace Adback\ApiClientBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('dekalee_adback_analytics');

        $supportedCacheTypes = ['redis', 'doctrine', 'config_file'];

        $rootNode->children()
            ->scalarNode('access_token')->isRequired()->end()
            ->scalarNode('api_url')->defaultValue('https://adback.co/api')->end()
            ->scalarNode('script_url')->defaultValue('script/me')->end()
            ->scalarNode('cache_type')
                ->validate()
                    ->ifNotInArray($supportedCacheTypes)
                    ->thenInvalid('The driver %s is not supported. Please choose one of '.json_encode($supportedCacheTypes))
                ->end()
                ->cannotBeOverwritten()
                ->cannotBeEmpty()
                ->defaultValue('redis')
            ->end()
            ->scalarNode('cache_service')->defaultValue('redis')->end()
            ->scalarNode('entity_manager')->defaultValue('doctrine.orm.entity_manager')->end()
        ->end();

        return $treeBuilder;
    }
}
