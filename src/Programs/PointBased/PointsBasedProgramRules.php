<?php

namespace Mbsoft\LoyaltyScore\Programs\PointBased;

use Spatie\LaravelData\Data;

class PointsBasedProgramRules extends Data
{
    public function __construct(
        public EarnPoints $earnPoints,
        public RedeemPoints $redeemPoints,
    ) {}

    static public function fromArray(array $data): self
    {
        return new self(
            earnPoints: EarnPoints::fromArray($data['earn_points']),
            redeemPoints: RedeemPoints::fromArray($data['redeem_points']),
        );
    }
}

