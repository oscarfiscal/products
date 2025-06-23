<?php

namespace App\GraphQL\Queries;

use App\Application\Services\ProductService;
use App\Application\Services\CategoryService;

class ProductQuery
{
    public function __construct(
        private ProductService $productService,
        private CategoryService $categoryService
    ) {}

    public function all(): array
    {
        $products = $this->productService->listProducts();

        return array_map(function ($product) {

            $category = $this->categoryService->getCategory($product->categoryId());

            return [
                'id' => $product->id(),
                'name' => $product->name(),
                'description' => $product->description(),
                'price' => $product->price()->amount(),
                'category' => [
                    'id' => $category?->id(),
                    'name' => $category?->name(),
                ],
            ];
        }, $products);
    }
}
