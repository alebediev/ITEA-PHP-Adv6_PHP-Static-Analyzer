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

namespace Greeflas\StaticAnalyzer\Analyzer;

/**
 * This is analyzer of classes - shows statistics information about analyzed class:
 * class type, properties counts, methods counts.
 *
 * @author Andrii Lebedeiv <wasaby.stnc@gmail.com>
 */
class ClassPropertiesAndMethodsAnalyzer
{
    private $reflectedClass;

    public function __construct(\ReflectionClass $reflectedClass)
    {
        $this->reflectedClass = $reflectedClass;
    }

    /**
     * Return analyzed class type.
     *
     * @return string
     */
    public function getClassType(): string
    {
        if ($this->reflectedClass->isAbstract()) {
            return 'abstract';
        }

        if ($this->reflectedClass->isFinal()) {
            return 'final';
        }

        if ($this->reflectedClass->isInterface()) {
            return 'interface';
        }

        if ($this->reflectedClass->isTrait()) {
            return 'trait';
        }

        return 'normal';
    }

    /**
     * Return count class methods by visibility.
     *
     * @param int|null $filter
     *
     * @return int
     */
    public function getClassMethodsQuantity(?int $filter): int
    {
        return \count($this->reflectedClass->getMethods($filter));
    }

    /**
     * Return count class properties by visibility.
     *
     * @param int|null $filter
     *
     * @return int
     */
    public function getClassPropertiesQuantity(?int $filter): int
    {
        return \count($this->reflectedClass->getProperties($filter));
    }
}
