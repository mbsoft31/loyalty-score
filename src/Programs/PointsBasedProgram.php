<?php

namespace Mbsoft\LoyaltyScore\Programs;

use Mbsoft\LoyaltyScore\Contracts\EarningPointsInterface;
use Mbsoft\LoyaltyScore\Contracts\RedeemingPointsInterface;
use Mbsoft\LoyaltyScore\Programs\PointBased\PointsBasedProgramRules;

class PointsBasedProgram extends LoyaltyProgram implements EarningPointsInterface, RedeemingPointsInterface
{
    protected PointsBasedProgramRules $rules;

    public function __construct(array $program)
    {
        parent::__construct($program);
        $this->rules = PointsBasedProgramRules::fromArray($program['rules']);
    }

    public function process(array $context = []): bool
    {
        if ($this->isValid()) {
            echo "\n\n" . $this->name . " is active" . "\n";

            echo "\tAmount spent: " . $context["amount"] . "\n";

            $earnedPoints = $this->calculatePoints( // Earned 1000 points for $100
                amount: $context["amount"],
                context: $context,
            );

            echo "\tearned points: " . $earnedPoints . "\n";

            $redeemableValue = 0.0;
            if ($this->canRedeem($earnedPoints)) {
                $redeemableValue = $this->calculateRedemption( // $10 discount
                    points: $earnedPoints,
                    context: $context,
                );
                echo "\nProgram is redeemable: \n";
                echo "\tredeemable dollars: $" . $redeemableValue . "\n";
            }else {
                echo "Program is not redeemable.\n";
                echo "\tredeemable dollars: $" . $redeemableValue . "\n";
                echo "\n\n";
                return false;
            }
            echo "\n\n";
            return true;
        } else {
            echo "Points Based Program is not active" . "\n";
            echo "\n\n";
            return false;
        }
    }

    public function calculatePoints(float $amount, array $context = []): int
    {
        return $this->rules->earnPoints->calculatePoints($amount, $context);
    }

    public function calculateRedemption(int $points, array $context = []): float
    {
        return $this->rules->redeemPoints->calculateRedemption($points, $context);
    }

    public function canRedeem(int $points): bool
    {
        return $this->rules->redeemPoints->canRedeem($points);
    }
}
