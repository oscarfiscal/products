<?php

namespace App\GraphQL\Queries;

use App\Application\Services\CategoryService;

class CategoryQuery
{
    public function __construct(private CategoryService $categoryService) {}

    public function all(): array
    {
        return $this->categoryService->listCategories();
    }
}
