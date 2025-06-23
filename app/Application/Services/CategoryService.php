<?php

namespace App\Application\Services;

use App\Domain\Repositories\CategoryRepositoryInterface;
use App\Domain\Entities\Category;

class CategoryService
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {}

    public function listCategories(): array
    {
        return $this->categoryRepository->findAll();
    }

    public function getCategory(int $id): ?Category
    {
        return $this->categoryRepository->findById($id);
    }

    public function createCategory(Category $category): Category
    {
        return $this->categoryRepository->create($category);
    }

    public function updateCategory(Category $category): Category
    {
        return $this->categoryRepository->update($category);
    }
}
