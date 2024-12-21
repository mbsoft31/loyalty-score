<?php

namespace Mbsoft\LoyaltyScore\Programs\Cashback;

use Spatie\LaravelData\Data;

class Validity extends Data
{
    public function __construct(
        public bool $isActive,
        public string $startDate,
        public string $endDate,
    ) {}
    public static function fromArray(array $validity): self
    {
        return new self(
            isActive: $validity['is_active'],
            startDate: $validity['start_date'],
            endDate: $validity['end_date']
        );
    }
}
