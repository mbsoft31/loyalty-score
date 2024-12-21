<?php

namespace Mbsoft\LoyaltyScore\Contracts;

interface EarningPointsInterface
{
    public function calculatePoints(float $amount, array $context = []): int;
}
