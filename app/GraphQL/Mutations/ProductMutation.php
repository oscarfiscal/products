<?php

namespace App\GraphQL\Mutations;

use App\Application\Services\CategoryService;
use App\Application\Services\ProductService;
use App\Domain\Entities\Product;
use App\Domain\ValueObjects\Price;

class ProductMutation
{
    public function __construct(
        private ProductService $productService,
        private CategoryService $categoryService
    ) {}

    public function create($root, array $args): array
    {
        $input = $args['input'];
        $product = new Product(
            $input['name'],
            $input['description'],
            new Price((float) $input['price']),
            (int) $input['category_id']
        );
        $result = $this->productService->createProduct($product);

        $category = $this->categoryService->getCategory($result->categoryId());

        return [
            'id' => $result->id(),
            'name' => $result->name(),
            'description' => $result->description(),
            'price' => $result->price()->amount(),
            'category' => [
                'id' => $category?->id(),
                'name' => $category?->name(),
            ],
        ];
    }


    public function update($root, array $args): array
    {
        $input = $args['input'];
        $existing = $this->productService->getProduct((int)$args['id']);

        $product = new Product(
            $input['name'] ?? $existing->name(),
            $input['description'] ?? $existing->description(),
            isset($input['price']) ? new Price((float) $input['price']) : $existing->price(),
            isset($input['category_id']) ? (int) $input['category_id'] : $existing->categoryId(),
            (int) $args['id']
        );
        $result = $this->productService->updateProduct($product);

        $category = $this->categoryService->getCategory($result->categoryId());

        return [
            'id' => $result->id(),
            'name' => $result->name(),
            'description' => $result->description(),
            'price' => $result->price()->amount(),
            'category' => [
                'id' => $category?->id(),
                'name' => $category?->name(),
            ],
        ];
    }


    public function delete($root, array $args): bool
    {
        $this->productService->deleteProduct((int)$args['id']);
        return true;
    }
}
