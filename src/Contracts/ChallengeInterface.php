<?php

namespace Mbsoft\LoyaltyScore\Contracts;

interface ChallengeInterface
{
    public function evaluateChallenge(array $context): bool;
    public function getRewardPoints(): int;
    public function getDescription(): string;
}
