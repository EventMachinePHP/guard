<?php

declare(strict_types=1);

namespace EventMachinePHP\Guard\Tests\Benchmark;

/**
 * +------------------+---------+---------+--------+---------+
 * | subject          | memory  | mode    | rstdev | stdev   |
 * +------------------+---------+---------+--------+---------+
 * | benchNegation () | 4.073mb | 0.073μs | ±8.27% | 0.006μs |
 * | benchDirect ()   | 4.073mb | 0.074μs | ±8.10% | 0.006μs |
 * +------------------+---------+---------+--------+---------+.
 */

/**
 * @BeforeMethods({"setUp"})
 */
class ComparisonBench
{
    protected int $passingValue;

    protected int $failingValue;

    protected int $min;

    protected int $max;

    /**
     * @throws \Exception
     */
    public function setUp(): void
    {
        $this->passingValue = random_int(1000000, 9999999);
        $this->min          = $this->passingValue - random_int(10000, 99999);
        $this->max          = $this->passingValue + random_int(10000, 99999);

        $this->failingValue = ((bool) random_int(0, 1)) ? $this->min - 1 : $this->max + 1;
    }

    /**
     * @Revs(1000000)
     *
     * @Iterations(5)
     *
     * @Warmup(3)
     */
    public function benchNegation(): void
    {
        !($this->passingValue > $this->min && $this->passingValue < $this->max);
        !($this->failingValue > $this->min && $this->failingValue < $this->max);
    }

    /**
     * @Revs(1000000)
     *
     * @Iterations(5)
     *
     * @Warmup(3)
     */
    public function benchDirect(): void
    {
        $this->passingValue <= $this->min || $this->passingValue >= $this->max;
        $this->failingValue <= $this->min || $this->failingValue >= $this->max;
    }
}
