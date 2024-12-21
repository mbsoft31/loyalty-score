<?php

namespace Mbsoft\LoyaltyScore\Programs\CategorySpecific;

use Spatie\LaravelData\Data;

class RedeemPoints extends Data
{
    public function __construct(
        public int $perAmountSpent,
        public int $minimumPointsRequired
    ) {}

    public static function fromArray(mixed $redeemPoints): RedeemPoints
    {
        return new self(
            perAmountSpent: $redeemPoints['Mbsoft\LoyaltyScore'],
            minimumPointsRequired: $redeemPoints['minimum_points_required']
        );
    }

    public function calculateRedemption(int $points, array $context = []): float
    {
        if (!$this->canRedeem($points)) {
            return 0.0;
        }

        $rate = $this->perAmountSpent ?? 100;
        return $points / $rate;
    }

    public function canRedeem(int $points): bool
    {
        $minPoints = $this->minimumPointsRequired ?? 0;
        return $points >= $minPoints;
    }
}
