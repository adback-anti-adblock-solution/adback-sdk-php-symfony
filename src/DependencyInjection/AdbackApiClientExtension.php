<?php

namespace Adback\ApiClientBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class AdbackApiClientExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $cacheType = $config['cache_type'];
        $generatorType = $config['generator_type'];
        $container->setParameter('adback_api_client.api.access_token', $config['access_token']);
        $container->setParameter('adback_api_client.api.api_url', $config['api_url']);
        $container->setParameter('adback_api_client.api.script_url', $config['script_url']);
        if (('redis' === $cacheType || 'predis' === $cacheType) && array_key_exists('cache_service', $config)) {
            $container->setAlias('adback_api_client.cache', $config['cache_service']);
        }
        if ('doctrine' == $cacheType && array_key_exists('entity_manager', $config)) {
            $container->setAlias('adback_api_client.orm.entity_manager', $config['entity_manager']);
        }

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('client.yml');
        $loader->load($generatorType . '_query.yml');
        $loader->load($cacheType . '_script_cache.yml');
        $loader->load($generatorType . '_generator.yml');
        $loader->load('twig.yml');
        $loader->load('command.yml');
        $loader->load('global_generator.yml');
    }
}
