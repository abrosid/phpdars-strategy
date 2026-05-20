<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Strategy\BillingPeriodInterface;
use App\Domain\Strategy\HalfYearlyBilling;
use App\Domain\Strategy\MonthlyBilling;
use App\Domain\Strategy\QuarterlyBilling;
use App\Domain\Strategy\YearlyBilling;

class CalculatorTypeRegistry
{
    public function getType(PlanType $planType): ?BillingPeriodInterface
    {
        return match ($planType) {
            PlanType::MONTHLY => new MonthlyBilling(),
            PlanType::YEARLY => new YearlyBilling(),
            PlanType::HALF_YEARLY => new HalfYearlyBilling(),
            PlanType::QUARTERLY => new QuarterlyBilling(),
        };
    }
}
