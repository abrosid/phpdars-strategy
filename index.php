<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\Domain\BillingCalculator\BillingCalculatorService;
use App\Domain\BillingCalculator\CalculatorTypeRegistry;
use App\Domain\BillingCalculator\PlanType;

$calculator = new CalculatorTypeRegistry();
$billingCalculator = new BillingCalculatorService($calculator);

$signupDate = new DateTimeImmutable('2025-01-30 00:00:00');
$date = $billingCalculator->calculateNextBillingDate($signupDate, PlanType::MONTHLY);
echo $date->format('Y-m-d H:i:s');
echo PHP_EOL;

$signupDate = new DateTimeImmutable('2025-02-28 00:00:00');
$date = $billingCalculator->calculateNextBillingDate($signupDate, PlanType::QUARTERLY);
echo $date->format('Y-m-d H:i:s');
echo PHP_EOL;
