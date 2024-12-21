<?php

namespace Mbsoft\LoyaltyScore\Programs;

use Mbsoft\LoyaltyScore\Traits\GamifiedTrait;

class GamifiedLoyaltyProgram extends LoyaltyProgram
{
    use GamifiedTrait;

    public function evaluateAndReward(int $customerId, array $context): array
    {
        return $this->checkAndRewardChallenges($customerId, $context);
    }

    public function process(array $context): bool
    {
        // TODO: Implement process() method.
    }
}
