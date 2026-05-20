<?php

declare(strict_types=1);

namespace App\Domain\Strategy;

use DateTimeImmutable;
use Throwable;

interface BillingPeriodInterface
{
    /**
     * @throws Throwable
     */
    public function calculateNextDate(DateTimeImmutable $signupDate): DateTimeImmutable;
}
