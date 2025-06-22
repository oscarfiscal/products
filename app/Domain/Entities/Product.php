<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\Price;

class Product
{
    private ?int $id;
    private string $name;
    private string $description;
    private Price $price;
    private int $categoryId;

    public function __construct(string $name, string $description, Price $price, int $categoryId, ?int $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->categoryId = $categoryId;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function price(): Price
    {
        return $this->price;
    }

    public function categoryId(): int
    {
        return $this->categoryId;
    }
}
