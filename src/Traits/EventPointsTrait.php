<?php

namespace Mbsoft\LoyaltyScore\Traits;

trait EventPointsTrait
{
    protected function calculateEventBonus(string $eventType, array $eventRules): int
    {
        return $eventRules[$eventType] ?? 0; // Return the points for the given event type
    }
}
