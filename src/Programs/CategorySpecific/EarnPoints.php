<?php

namespace Mbsoft\LoyaltyScore\Programs\CategorySpecific;

use Mbsoft\LoyaltyScore\Traits\CategoryPointsTrait;
use Spatie\LaravelData\Data;

class EarnPoints extends Data
{
    use CategoryPointsTrait;

    public function __construct(
        public int $perAmountSpent,
        public ?array $categories = null,
    ) {}

    public static function fromArray(mixed $earnPoints): self
    {
        return new self(
            perAmountSpent: $earnPoints['per_amount_spent'],
            categories: $earnPoints['categories']?? null,
        );
    }

    public function calculatePoints(float $amount, array $context = []): int
    {
        $category = $context['category'] ?? 'default';
        $categoryRules = $this->categories ?? [];
        return $this->calculateCategoryPoints($amount, $category, $categoryRules);
    }
}
