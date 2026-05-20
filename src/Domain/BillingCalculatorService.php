<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Strategy\PlanTypeNotRegisteredException;
use DateTimeImmutable;
use Throwable;

class BillingCalculatorService
{
    public function __construct(
        private readonly CalculatorTypeRegistry $calculatorTypeRegistry
    ) {
    }

    /**
     * @param DateTimeImmutable $signupDate
     * @param PlanType $plan
     * @return DateTimeImmutable
     * @throws Throwable
     */
    public function calculateNextBillingDate(DateTimeImmutable $signupDate, PlanType $plan): DateTimeImmutable
    {
        $calculatorType = $this->calculatorTypeRegistry->getType($plan);
        if (!$calculatorType) {
            throw new PlanTypeNotRegisteredException('Calculator type is not registered');
        }
        return $calculatorType->calculateNextDate($signupDate);
    }
}
