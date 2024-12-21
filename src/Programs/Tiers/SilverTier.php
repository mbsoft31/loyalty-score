<?php

namespace Mbsoft\LoyaltyScore\Programs\Tiers;

use Mbsoft\LoyaltyScore\Contracts\TierInterface;

class SilverTier implements TierInterface
{
    public function getName(): string
    {
        return 'Silver';
    }

    public function getMultiplier(): float
    {
        return 1.5;
    }

    public function getBenefits(): array
    {
        return ['1.5x points accrual', 'Free shipping'];
    }

    public function isEligible(float $totalSpent): bool
    {
        return $totalSpent >= 1000 && $totalSpent < 5000;
    }
}
