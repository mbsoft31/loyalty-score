<?php

namespace Mbsoft\LoyaltyScore\Programs\Cashback;

use Spatie\LaravelData\Data;

class RedeemPoints extends Data
{
    public function __construct(
        public int $pointsPerAmountCashback,
        public int $minimumPointsRequired
    ) {}

    public static function fromArray(mixed $redeemPoints): RedeemPoints
    {
        return new self(
            pointsPerAmountCashback: $redeemPoints['points_per_amount_cashback'],
            minimumPointsRequired: $redeemPoints['minimum_points_required']
        );
    }

    public function calculateRedemption(int $points, array $context = []): float
    {
        if (!$this->canRedeem($points)) {
            return 0.0;
        }

        $conversionRate = $this->pointsPerAmountCashback ?? 100;
        return $points / $conversionRate;
    }

    public function canRedeem(int $points): bool
    {
        $minPoints = $this->minimumPointsRequired ?? 0;
        return $points >= $minPoints;
    }
}
