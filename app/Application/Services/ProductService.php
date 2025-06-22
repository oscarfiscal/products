<?php

namespace App\Application\Services;

use App\Domain\Repositories\ProductRepositoryInterface;
use App\Domain\Entities\Product;

class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {}

    public function listProducts(): array
    {
        return $this->productRepository->findAll();
    }

    public function getProduct(int $id): ?Product
    {
        return $this->productRepository->findById($id);
    }

    public function createProduct(Product $product): Product
    {
        return $this->productRepository->create($product);
    }

    public function updateProduct(Product $product): Product
    {
        return $this->productRepository->update($product);
    }

    public function deleteProduct(int $id): void
    {
        $this->productRepository->delete($id);
    }
}
