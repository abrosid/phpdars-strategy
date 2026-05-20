<?php

declare(strict_types=1);

namespace App\Domain\Strategy;

use DateTimeImmutable;

class HalfYearlyBilling implements BillingPeriodInterface
{
    public function calculateNextDate(DateTimeImmutable $signupDate): DateTimeImmutable
    {
        return $signupDate->modify('+6 months');
    }
}
