<?php

declare(strict_types=1);

namespace App\Domain\BillingCalculator;

use App\Domain\BillingCalculator\Strategy\BillingPeriodInterface;
use App\Domain\BillingCalculator\Strategy\HalfYearlyBilling;
use App\Domain\BillingCalculator\Strategy\MonthlyBilling;
use App\Domain\BillingCalculator\Strategy\PlanTypeNotRegisteredException;
use App\Domain\BillingCalculator\Strategy\QuarterlyBilling;
use App\Domain\BillingCalculator\Strategy\YearlyBilling;
use UnhandledMatchError;

class CalculatorTypeRegistry
{
    /**
     * @throws PlanTypeNotRegisteredException
     */
    public function getType(PlanType $planType): BillingPeriodInterface
    {
        try {
            return match ($planType) {
                PlanType::MONTHLY => new MonthlyBilling(),
                PlanType::YEARLY => new YearlyBilling(),
                PlanType::HALF_YEARLY => new HalfYearlyBilling(),
                PlanType::QUARTERLY => new QuarterlyBilling(),
            };
        } catch (UnhandledMatchError $exception) {
            throw new PlanTypeNotRegisteredException('Unexpected planType: ' . $planType->value);
        }
    }
}
