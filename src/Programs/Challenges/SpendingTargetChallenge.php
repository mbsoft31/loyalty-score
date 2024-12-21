<?php

namespace Mbsoft\LoyaltyScore\Programs\Challenges;

use Mbsoft\LoyaltyScore\Contracts\ChallengeInterface;

class SpendingTargetChallenge implements ChallengeInterface
{
    protected float $targetAmount;
    protected int $rewardPoints;

    public function __construct(float $targetAmount, int $rewardPoints)
    {
        $this->targetAmount = $targetAmount;
        $this->rewardPoints = $rewardPoints;
    }

    public function evaluateChallenge(array $context): bool
    {
        return $context['total_spent'] >= $this->targetAmount;
    }

    public function getRewardPoints(): int
    {
        return $this->rewardPoints;
    }

    public function getDescription(): string
    {
        return "Spend at least \${$this->targetAmount} to earn {$this->rewardPoints} points.";
    }
}

