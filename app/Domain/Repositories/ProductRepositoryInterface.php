<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Product;

interface ProductRepositoryInterface
{
    public function findAll(): array;
    public function findById(int $id): ?Product;
    public function create(Product $product): Product;
    public function update(Product $product): Product;
    public function delete(int $id): void;
    public function findByCategory(int $categoryId): array;
}
