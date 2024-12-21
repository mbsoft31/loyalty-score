<?php

namespace Mbsoft\LoyaltyScore\Programs;

use Mbsoft\LoyaltyScore\Traits\TieredTrait;

class TieredLoyaltyProgram extends LoyaltyProgram
{
    use TieredTrait;

    /**
     * @throws \Exception
     */
    public function assignTier(int $customerId, float $totalSpent): void
    {
        $tier = $this->determineTier($totalSpent);
        // Store the customer's tier in the database
        // DB::table('customers')->where('id', $customerId)->update(['tier' => $tier->getName()]);
    }

    public function process(array $context): bool
    {
        // TODO: Implement process() method.
    }
}
