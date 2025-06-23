<?php

namespace App\Domain\ValueObjects;

class Price
{
    private float $amount;

    public function __construct(float $amount)
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException('Price cannot be negative.');
        }

        $this->amount = $amount;
    }

    public function amount(): float
    {
        return $this->amount;
    }

    public function __toString(): string
    {
        return number_format($this->amount, 2);
    }
}
