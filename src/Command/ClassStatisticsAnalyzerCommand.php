<?php

declare(strict_types=1);

/*
 * This file is part of the "PHP Static Analyzer" project.
 *
 * (c) Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Greeflas\StaticAnalyzer\Command;

use Greeflas\StaticAnalyzer\Analyzer\ClassPropertiesAndMethodsAnalyzer as Analyzer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command stat:class-analyzer.
 *
 * @author Andrii Lebedeiv <wasaby.stnc@gmail.com>
 */
final class ClassStatisticsAnalyzerCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setName('stat:class-analyzer')
            ->setDescription('Shows statistics information about analyzed class')
            ->addArgument(
                'fullClassName',
                InputArgument::REQUIRED,
                'Full analyzed class name (include namespace)'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $fullClassName = $input->getArgument('fullClassName');

        try {
            $reflectedClass = new \ReflectionClass($fullClassName);
        } catch (\ReflectionException $e) {
            $output->writeln([
                '<error>Errors occurred during the command execution!</error>',
                $e->getMessage(),
            ]);

            return 1;
        }

        $analyzer = new Analyzer($reflectedClass);

        $output->writeln([
            'Class: ' . $fullClassName . ' is ' . $analyzer->getClassType(),
            'Properties:',
            "\tpublic: " . $analyzer->getClassPropertiesQuantity(\ReflectionProperty::IS_PUBLIC),
            "\tprotected: " . $analyzer->getClassPropertiesQuantity(\ReflectionProperty::IS_PROTECTED),
            "\tprivate: " . $analyzer->getClassPropertiesQuantity(\ReflectionProperty::IS_PRIVATE),
            'Methods:',
            "\tpublic: " . $analyzer->getClassMethodsQuantity(\ReflectionMethod::IS_PUBLIC),
            "\tprotected: " . $analyzer->getClassMethodsQuantity(\ReflectionMethod::IS_PROTECTED),
            "\tprivate: " . $analyzer->getClassMethodsQuantity(\ReflectionMethod::IS_PRIVATE),
        ]);

        return 0;
    }
}
