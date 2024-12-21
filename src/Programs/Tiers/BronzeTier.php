<?php

namespace Mbsoft\LoyaltyScore\Programs\Tiers;

use Mbsoft\LoyaltyScore\Contracts\TierInterface;

class BronzeTier implements TierInterface
{
    public function getName(): string
    {
        return 'Bronze';
    }

    public function getMultiplier(): float
    {
        return 1.0;
    }

    public function getBenefits(): array
    {
        return ['Standard points accrual'];
    }

    public function isEligible(float $totalSpent): bool
    {
        return $totalSpent < 1000;
    }
}
