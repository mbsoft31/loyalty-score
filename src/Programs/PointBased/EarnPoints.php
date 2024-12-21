<?php

namespace Mbsoft\LoyaltyScore\Programs\PointBased;

use Spatie\LaravelData\Data;

class EarnPoints extends Data
{
    public function __construct(
        public int $perAmountSpent
    ) {}

    public static function fromArray(mixed $earnPoints): self
    {
        return new self(
            perAmountSpent: $earnPoints['per_amount_spent']
        );
    }

    public function calculatePoints(float $amount, array $context = []): int
    {
        return $amount * $this->perAmountSpent ?? 0;
    }
}
