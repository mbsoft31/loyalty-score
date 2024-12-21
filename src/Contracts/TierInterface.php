<?php

namespace Mbsoft\LoyaltyScore\Contracts;

interface TierInterface
{
    public function getName(): string;
    public function getMultiplier(): float;
    public function getBenefits(): array;
    public function isEligible(float $totalSpent): bool;
}
