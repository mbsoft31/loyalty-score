<?php

namespace Mbsoft\LoyaltyScore\Programs;

use Mbsoft\LoyaltyScore\Contracts\EarningPointsInterface;
use Mbsoft\LoyaltyScore\Contracts\EventRewardsInterface;
use Mbsoft\LoyaltyScore\Contracts\RedeemingPointsInterface;
use Mbsoft\LoyaltyScore\Traits\EventPointsTrait;

class EventBasedProgram extends LoyaltyProgram implements EarningPointsInterface, RedeemingPointsInterface, EventRewardsInterface
{
    use EventPointsTrait;

    public function calculatePoints(float $amount, array $context = []): int
    {
        return $amount * ($this->rulesList['earn_points']['per_dollar_spent'] ?? 0);
    }

    public function calculateEventPoints(string $eventType, array $context = []): int
    {
        $eventRules = $this->rulesList['event_bonus'] ?? [];
        return $this->calculateEventBonus($eventType, $eventRules);
    }

    public function calculateRedemption(int $points, array $context = []): float
    {
        // TODO: Implement calculateRedemption() method.
    }

    public function canRedeem(int $points): bool
    {
        // TODO: Implement canRedeem() method.
    }

    public function process(array $context): bool
    {
        // TODO: Implement process() method.
    }
}
