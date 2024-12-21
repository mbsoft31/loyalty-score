<?php

namespace Mbsoft\LoyaltyScore\Programs\Challenges;

use Mbsoft\LoyaltyScore\Contracts\ChallengeInterface;

class PurchaseCountChallenge implements ChallengeInterface
{
    protected int $requiredPurchases;
    protected int $rewardPoints;

    public function __construct(int $requiredPurchases, int $rewardPoints)
    {
        $this->requiredPurchases = $requiredPurchases;
        $this->rewardPoints = $rewardPoints;
    }

    public function evaluateChallenge(array $context): bool
    {
        return $context['purchase_count'] >= $this->requiredPurchases;
    }

    public function getRewardPoints(): int
    {
        return $this->rewardPoints;
    }

    public function getDescription(): string
    {
        return "Complete {$this->requiredPurchases} purchases to earn {$this->rewardPoints} points.";
    }
}
