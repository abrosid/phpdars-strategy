<?php

declare(strict_types=1);

namespace App\Domain\BillingCalculator\Strategy;

use DateTimeImmutable;

class YearlyBilling implements BillingPeriodInterface
{
    public function calculateNextDate(DateTimeImmutable $signupDate): DateTimeImmutable
    {
        return $signupDate->modify('+1 year');
    }
}
