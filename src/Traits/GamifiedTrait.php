<?php

namespace Mbsoft\LoyaltyScore\Traits;

use Mbsoft\LoyaltyScore\Contracts\ChallengeInterface;

trait GamifiedTrait
{
    protected array $challenges = [];

    public function addChallenge(ChallengeInterface $challenge): void
    {
        $this->challenges[] = $challenge;
    }

    public function checkAndRewardChallenges(int $customerId, array $context): array
    {
        $completedChallenges = [];

        foreach ($this->challenges as $challenge) {
            if ($challenge->evaluateChallenge($context)) {
                $this->rewardPoints($customerId, $challenge->getRewardPoints());
                $completedChallenges[] = $challenge->getDescription();
            }
        }

        return $completedChallenges;
    }

    protected function rewardPoints(int $customerId, int $points): void
    {
        // Logic to increment customer's points balance
        /*DB::table('customers')
            ->where('id', $customerId)
            ->increment('points_balance', $points);*/
    }
}
