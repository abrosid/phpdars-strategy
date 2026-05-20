<?php

declare(strict_types=1);

namespace App\Domain\BillingCalculator;

enum PlanType: string
{
    case MONTHLY = 'monthly';
    case QUARTERLY = 'quarterly';
    case HALF_YEARLY = 'half-yearly';
    case YEARLY = 'yearly';
    case UNKNOWN = 'unknown';
}
