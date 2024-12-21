<?php

namespace Mbsoft\LoyaltyScore\Programs;

use DateTime;

abstract class LoyaltyProgram
{
    public mixed $name;
    public mixed $description;
    public bool $isActive;
    public string $startDate;
    public string $endDate;

    public function __construct(array $program)
    {
        $this->name = $program["name"];
        $this->description = $program["description"];
        $this->isActive = $program["is_active"];
        $this->startDate = $program["start_date"];
        $this->endDate = $program["end_date"];
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    protected function isWithinValidity(): bool
    {
        $now = new DateTime();
        try {
            return $now >= new DateTime($this->startDate) && $now <= new DateTime($this->endDate);
        } catch (\DateMalformedStringException $e) {
            // TODO: Handle this exception
            echo "LoyaltyProgram.isWithinValidity(): " . $e->getMessage();
            return false;
        }
    }

    public function isValid(): bool
    {
        return $this->isActive && $this->isWithinValidity();
    }

    public abstract function process(array $context): bool;
}

