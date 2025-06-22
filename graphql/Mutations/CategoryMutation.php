<?php

namespace App\GraphQL\Mutations;

use App\Application\Services\CategoryService;
use App\Domain\Entities\Category;

class CategoryMutation
{
    public function __construct(private CategoryService $categoryService) {}

    public function create($root, array $args): Category
    {
        $input = $args['input'];
        $category = new Category($input['name']);
        return $this->categoryService->createCategory($category);
    }

    public function update($root, array $args): Category
    {
        $existing = $this->categoryService->getCategory((int)$args['id']);
        $input = $args['input'];
        $category = new Category(
            $input['name'] ?? $existing->name(),
            (int) $args['id']
        );
        return $this->categoryService->updateCategory($category);
    }
}
