<?php

namespace Mbsoft\LoyaltyScore\Traits;

trait CategoryPointsTrait
{
    protected function calculateCategoryPoints(float $amount, string $category, array $categoryRules): int
    {
        if (isset($categoryRules[$category])) {
            return $amount * $categoryRules[$category];
        }
        return $categoryRules['default'] ?? 0; // default or No points for this category
    }
}
