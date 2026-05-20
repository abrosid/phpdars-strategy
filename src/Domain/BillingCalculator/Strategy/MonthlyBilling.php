<?php

declare(strict_types=1);

namespace App\Domain\BillingCalculator\Strategy;

use DateTimeImmutable;

class MonthlyBilling implements BillingPeriodInterface
{
    public function calculateNextDate(DateTimeImmutable $signupDate): DateTimeImmutable
    {
        $currentDayOfMonth = $signupDate->format('d');
        $lastDayOfMonth = $signupDate->format('t');
        if ($currentDayOfMonth == $lastDayOfMonth) {
            return $signupDate->modify('last day of next month');
        } else {
            $signupDate = $signupDate->modify('+1 month');
            $nextMonthDay = $signupDate->format('d');
            if ($nextMonthDay == $currentDayOfMonth) {
                return $signupDate;
            } else {
                return $signupDate->modify('last day of previous month');
            }
        }
    }
}
