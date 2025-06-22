<?php

namespace App\GraphQL\Mutations;

use App\Application\Services\CategoryService;
use App\Domain\Entities\Category;

class CategoryMutation
{
    public function __construct(private CategoryService $categoryService) {}

    public function create($root, array $args): array
    {
        $input = $args['input'];
        $category = new Category($input['name']);
        $result = $this->categoryService->createCategory($category);

        return [
            'id' => $result->id(),
            'name' => $result->name()
        ];
    }


    public function update($root, array $args): array
    {
        $existing = $this->categoryService->getCategory((int)$args['id']);
        $input = $args['input'];
        $category = new Category(
            $input['name'] ?? $existing->name(),
            (int) $args['id']
        );
        $result = $this->categoryService->updateCategory($category);

        return [
            'id' => $result->id(),
            'name' => $result->name()
        ];
    }
}
