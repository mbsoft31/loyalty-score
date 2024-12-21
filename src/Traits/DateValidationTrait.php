<?php

namespace Mbsoft\LoyaltyScore\Traits;

use DateTime;

trait DateValidationTrait
{
    /**
     * @throws \DateMalformedStringException
     */
    protected function isWithinValidity(): bool
    {
        $now = new DateTime();
        return $now >= new DateTime($this->validity->startDate) && $now <= new DateTime($this->validity->endDate);
    }
}

