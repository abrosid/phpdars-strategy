<?php

namespace Domain\BillingCalculator;

use App\Domain\BillingCalculator\BillingCalculatorService;
use App\Domain\BillingCalculator\CalculatorTypeRegistry;
use App\Domain\BillingCalculator\PlanType;
use DateTime;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class BillingCalculatorServiceTest extends TestCase
{
    private readonly BillingCalculatorService $billingCalculatorService;
    public function setUp(): void
    {
        $this->billingCalculatorService = new BillingCalculatorService(new CalculatorTypeRegistry());
    }

    /**
     * @dataProvider dateProvider
     */
    public function testCalculateNextBillingDate(DateTimeImmutable $signupDate, PlanType $planType, DateTime $expected): void
    {
        $nextMonth = $this->billingCalculatorService->calculateNextBillingDate($signupDate, $planType);
        $this->assertEquals($expected, $nextMonth);
    }

    function dateProvider(): array
    {
        return [
            [
                new DateTimeImmutable('2025-01-30'),
                PlanType::MONTHLY,
                new DateTime('2025-02-28'),
            ],
            [
                new DateTimeImmutable('2025-01-15'),
                PlanType::MONTHLY,
                new DateTime('2025-02-15'),
            ],
            [
                new DateTimeImmutable('2025-04-30'),
                PlanType::MONTHLY,
                new DateTime('2025-05-31'),
            ],
            [
                new DateTimeImmutable('2025-12-31'),
                PlanType::QUARTERLY,
                new DateTime('2026-03-31'),
            ],
            [
                new DateTimeImmutable('2025-12-15'),
                PlanType::HALF_YEARLY,
                new DateTime('2026-06-15'),
            ],
            [
                new DateTimeImmutable('2025-12-31 00:00:00'),
                PlanType::YEARLY,
                new DateTime('2026-12-31'),
            ]
        ];

    }
}
