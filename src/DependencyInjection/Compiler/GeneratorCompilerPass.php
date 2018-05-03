<?php

namespace Adback\ApiClientBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class GeneratorCompilerPass
 */
class GeneratorCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     * @param string           $generator
     * @param string           $tagName
     */
    protected function addGenerators(ContainerBuilder $container, $generator, $tagName)
    {
        if (!$container->hasDefinition($generator)) {
            return;
        }
        $manager = $container->getDefinition($generator);
        $strategies = $container->findTaggedServiceIds($tagName);
        foreach ($strategies as $id => $attributes) {
            $manager->addMethodCall('addGenerator', array(new Reference($id)));
        }
    }

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $generator = 'adback_api_client.generator.global';
        $tagName = 'adback_api.client.generator.strategy';

        $this->addGenerators($container, $generator, $tagName);
    }
}
