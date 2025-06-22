<?php

namespace App\GraphQL\Queries;

use App\Application\Services\ProductService;

class ProductQuery
{
    public function __construct(private ProductService $productService) {}

    public function all(): array
    {
        return $this->productService->listProducts();
    }
}
