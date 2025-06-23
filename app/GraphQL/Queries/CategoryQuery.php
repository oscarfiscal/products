<?php

namespace App\GraphQL\Queries;

use App\Application\Services\CategoryService;
use App\Application\Services\ProductService;

class CategoryQuery
{
    public function __construct(
        private CategoryService $categoryService,
        private ProductService $productService
    ) {}

    public function all(): array
    {
        $categories = $this->categoryService->listCategories();

        return array_map(function ($category) {
            // Obtén los productos asociados usando el ProductService
            $products = $this->productService->listProductsByCategory($category->id());

            return [
                'id' => $category->id(),
                'name' => $category->name(),
                'products' => array_map(function ($product) {
                    return [
                        'id' => $product->id(),
                        'name' => $product->name(),
                        'price' => $product->price()->amount(),
                    ];
                }, $products),
            ];
        }, $categories);
    }
}
