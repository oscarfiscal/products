<?php

namespace App\GraphQL\Mutations;

use App\Application\Services\ProductService;
use App\Domain\Entities\Product;
use App\Domain\ValueObjects\Price;

class ProductMutation
{
    public function __construct(private ProductService $productService) {}

    public function create(array $root, array $args): Product
    {
        $input = $args['input'];
        $product = new Product(
            $input['name'],
            $input['description'],
            new Price((float) $input['price']),
            (int) $input['category_id']
        );
        return $this->productService->createProduct($product);
    }

    public function update($root, array $args): Product
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
        return $this->productService->updateProduct($product);
    }

    public function delete($root, array $args): bool
    {
        $this->productService->deleteProduct((int)$args['id']);
        return true;
    }
}
