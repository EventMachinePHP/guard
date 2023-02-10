<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests\Benchmark;

use EventMachinePHP\Guard\Guard;

class GuardBench
{
    /**
     * @Revs(100000)
     *
     * @Iterations(5)
     *
     * @Warmup(3)
     */
    public function benchEqualTo(): void
    {
        Guard::equalTo(1, 1);
    }

    /**
     * @Revs(100000)
     *
     * @Iterations(5)
     *
     * @Warmup(3)
     */
    public function benchIsString(): void
    {
        Guard::isString('value');
    }

    /**
     * @Revs(100000)
     *
     * @Iterations(5)
     *
     * @Warmup(3)
     */
    public function benchStr(): void
    {
        Guard::str('value');
    }
}
