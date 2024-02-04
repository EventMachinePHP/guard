<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests\Benchmark;

use EventMachinePHP\Guard\Guard;

class GuardOr
{
    /**
     * @Revs(100000)
     *
     * @Iterations(5)
     *
     * @Warmup(3)
     */
    public function benchIsBooleanTrue(): void
    {
        Guard::isBoolean(true);
    }

    /**
     * @Revs(100000)
     *
     * @Iterations(5)
     *
     * @Warmup(3)
     */
    public function benchIsBooleanOrTrue(): void
    {
        Guard::isBooleanOr(true, false);
    }

    /**
     * @Revs(100000)
     *
     * @Iterations(5)
     *
     * @Warmup(3)
     */
    public function benchIsBooleanOrFalse(): void
    {
        Guard::isBooleanOr(3, false);
    }
}
