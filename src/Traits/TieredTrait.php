<?php

namespace Mbsoft\LoyaltyScore\Traits;

use Exception;
use Mbsoft\LoyaltyScore\Contracts\TierInterface;

trait TieredTrait
{
    protected array $tiers = [];

    public function addTier(TierInterface $tier): void
    {
        $this->tiers[] = $tier;
        usort($this->tiers, function ($a, $b) {
            return $b->getMultiplier() <=> $a->getMultiplier();
        });
    }

    /**
     * @throws Exception
     */
    public function determineTier(float $totalSpent): TierInterface
    {
        foreach ($this->tiers as $tier) {
            if ($tier->isEligible($totalSpent)) {
                return $tier;
            }
        }

        throw new Exception('No eligible tier found.');
    }

    /**
     * @throws Exception
     */
    public function calculatePoints(float $amount, float $totalSpent): int
    {
        $tier = $this->determineTier($totalSpent);
        $multiplier = $tier->getMultiplier();
        return (int)($amount * $multiplier);
    }

    /**
     * @throws Exception
     */
    public function getTierBenefits(float $totalSpent): array
    {
        $tier = $this->determineTier($totalSpent);
        return $tier->getBenefits();
    }
}
