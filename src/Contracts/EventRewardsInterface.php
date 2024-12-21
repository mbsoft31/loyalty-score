<?php

namespace Mbsoft\LoyaltyScore\Contracts;

interface EventRewardsInterface
{
    public function calculateEventPoints(string $eventType, array $context = []): int;
}

