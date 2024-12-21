<?php

namespace Mbsoft\LoyaltyScore\Contracts;

interface RedeemingPointsInterface
{
    public function calculateRedemption(int $points, array $context = []): float;
    public function canRedeem(int $points): bool;
}
