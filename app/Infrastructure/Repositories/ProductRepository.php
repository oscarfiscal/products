<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Product;
use App\Domain\Repositories\ProductRepositoryInterface;
use App\Infrastructure\Models\ProductModel;
use App\Infrastructure\Models\CategoryModel;
use App\Domain\ValueObjects\Price;

class ProductRepository implements ProductRepositoryInterface
{
    public function findAll(): array
    {
        $products = ProductModel::with('category')->get();
        return $products->map(fn($product) => $this->toDomain($product))->all();
    }

    public function findById(int $id): ?Product
    {
        $product = ProductModel::with('category')->find($id);
        return $product ? $this->toDomain($product) : null;
    }

    public function create(Product $product): Product
    {
        $model = ProductModel::create([
            'name'        => $product->name(),
            'description' => $product->description(),
            'price'       => $product->price()->amount(),
            'category_id' => $product->categoryId()
        ]);
        $model->refresh();
        return $this->toDomain($model);
    }

    public function update(Product $product): Product
    {
        $model = ProductModel::findOrFail($product->id());
        $model->update([
            'name'        => $product->name(),
            'description' => $product->description(),
            'price'       => $product->price()->amount(),
            'category_id' => $product->categoryId()
        ]);
        $model->refresh();
        return $this->toDomain($model);
    }

    public function delete(int $id): void
    {
        ProductModel::destroy($id);
    }

    private function toDomain(ProductModel $model): Product
    {
        return new Product(
            $model->name,
            $model->description,
            new Price((float)$model->price),
            $model->category_id,
            $model->id
        );
    }

    public function findByCategory(int $categoryId): array
    {
        $products = ProductModel::where('category_id', $categoryId)->get();
        return $products->map(fn($model) => $this->toDomain($model))->all();
    }
}
