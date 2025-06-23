<?php

namespace App\Domain\Entities;

class Category
{
    private ?int $id;
    private string $name;

    public function __construct(string $name, ?int $id = null)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function id(): ?int
    {
        return $this->id;
    }


    public function name(): string
    {
        return $this->name;
    }
}
