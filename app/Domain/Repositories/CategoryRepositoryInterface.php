<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Category;

interface CategoryRepositoryInterface
{
    public function findAll(): array;
    public function findById(int $id): ?Category;
    public function create(Category $category): Category;
    public function update(Category $category): Category;
}
