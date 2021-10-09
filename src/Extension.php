<?php

declare(strict_types=1);

namespace Klx\GrumPhpX;

use GrumPHP\Extension\ExtensionInterface;
use Klx\GrumPhpX\Task\Larastan;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class Extension implements ExtensionInterface
{

    /**
     * Load function
     */

    public function load(ContainerBuilder $container): void
    {
        $container->register('task.larastan', Larastan::class)
            ->addArgument(new Reference('config'))
            ->addArgument(new Reference('process_builder'))
            ->addArgument(new Reference('formatter.raw_process'))
            ->addTag('grumphp.task', ['config' => 'larastan']);
    }
}
