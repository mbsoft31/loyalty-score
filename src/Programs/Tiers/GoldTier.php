<?php

namespace Mbsoft\LoyaltyScore\Programs\Tiers;

use Mbsoft\LoyaltyScore\Contracts\TierInterface;

class GoldTier implements TierInterface
{
    public function getName(): string
    {
        return 'Gold';
    }

    public function getMultiplier(): float
    {
        return 2.0;
    }

    public function getBenefits(): array
    {
        return ['2x points accrual', 'Free shipping', 'Exclusive discounts'];
    }

    public function isEligible(float $totalSpent): bool
    {
        return $totalSpent >= 5000;
    }
}
