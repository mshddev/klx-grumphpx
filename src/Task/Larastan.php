<?php

declare(strict_types=1);

namespace Klx\GrumPhpX\Task;

use GrumPHP\Runner\TaskResult;
use GrumPHP\Runner\TaskResultInterface;
use GrumPHP\Task\AbstractExternalTask;
use GrumPHP\Task\Context\ContextInterface;
use GrumPHP\Task\Context\GitPreCommitContext;
use GrumPHP\Task\Context\RunContext;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Larastan extends AbstractExternalTask
{
    public function getName(): string
    {
        return 'larastan';
    }

    public function getConfigurableOptions(): OptionsResolver
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'level' => 5,
            'paths' => ['app', 'config', 'tests'],
        ]);

        $resolver->addAllowedTypes('level', ['int']);
        $resolver->addAllowedTypes('paths', ['array']);

        return $resolver;
    }

    public function canRunInContext(ContextInterface $context): bool
    {
        return $context instanceof GitPreCommitContext || $context instanceof RunContext;
    }

    public function run(ContextInterface $context) : TaskResultInterface
    {
        $config = $this->getConfiguration();

        $arguments = $this->processBuilder->createArgumentsForCommand('php');
        $arguments->add('artisan');
        $arguments->add('code:analyse');

        if ($config['paths']) {
            $arguments->add('--paths='.implode(',', $config['paths']));
        }

        if ($config['level']) {
            $arguments->add('--level='.$config['level']);
        }

        $process = $this->processBuilder->buildProcess($arguments);
        $process->run();

        if (! $process->isSuccessful()) {
            return TaskResult::createFailed($this, $context, $this->formatter->format($process));
        }

        return TaskResult::createPassed($this, $context);
    }
}
