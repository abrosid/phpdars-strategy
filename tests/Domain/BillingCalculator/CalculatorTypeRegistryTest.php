<?php

namespace Domain\BillingCalculator;

use App\Domain\BillingCalculator\CalculatorTypeRegistry;
use App\Domain\BillingCalculator\PlanType;
use App\Domain\BillingCalculator\Strategy\HalfYearlyBilling;
use App\Domain\BillingCalculator\Strategy\MonthlyBilling;
use App\Domain\BillingCalculator\Strategy\PlanTypeNotRegisteredException;
use App\Domain\BillingCalculator\Strategy\QuarterlyBilling;
use App\Domain\BillingCalculator\Strategy\YearlyBilling;
use PHPUnit\Framework\TestCase;

class CalculatorTypeRegistryTest extends TestCase
{
    private readonly CalculatorTypeRegistry $registry;
    public function setUp(): void
    {
        $this->registry = new CalculatorTypeRegistry();
    }
    public function testGetCalculatorType(): void
    {
        $monthlyBilling = $this->registry->getType(PlanType::MONTHLY);
        $this->assertInstanceOf(MonthlyBilling::class, $monthlyBilling);

        $yearlyBilling = $this->registry->getType(PlanType::YEARLY);
        $this->assertInstanceOf(YearlyBilling::class, $yearlyBilling);

        $quarterlyBilling = $this->registry->getType(PlanType::QUARTERLY);
        $this->assertInstanceOf(QuarterlyBilling::class, $quarterlyBilling);

        $halfYearBilling = $this->registry->getType(PlanType::HALF_YEARLY);
        $this->assertInstanceOf(HalfYearlyBilling::class, $halfYearBilling);


        $this->expectException(PlanTypeNotRegisteredException::class);
        $this->registry->getType(PlanType::UNKNOWN);
    }

}
