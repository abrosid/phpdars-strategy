<?php declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use App\Domain\PlanType;
use App\Domain\CalculatorTypeRegistry;
use App\Domain\BillingCalculatorService;

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
