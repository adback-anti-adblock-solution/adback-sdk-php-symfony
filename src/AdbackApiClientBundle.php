<?php

namespace Adback\ApiClientBundle;

use Adback\ApiClientBundle\DependencyInjection\Compiler\GeneratorCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AdbackApiClientBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new GeneratorCompilerPass());
    }
}
