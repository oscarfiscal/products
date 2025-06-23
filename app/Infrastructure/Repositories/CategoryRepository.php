<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Category;
use App\Domain\Repositories\CategoryRepositoryInterface;
use App\Infrastructure\Models\CategoryModel;
use Illuminate\Support\Facades\Log;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function findAll(): array
    {
        $categories = CategoryModel::all();
        return $categories->map(fn($category) => $this->toDomain($category))->all();
    }

    public function findById(int $id): ?Category
    {
        $category = CategoryModel::find($id);
        return $category ? $this->toDomain($category) : null;
    }

    public function create(Category $category): Category
    {
        $model = CategoryModel::create(['name' => $category->name()]);
        $model->refresh();
        return $this->toDomain($model);
    }

    public function update(Category $category): Category
    {
        $model = CategoryModel::findOrFail($category->id());
        $model->update(['name' => $category->name()]);
        $model->refresh();
        return $this->toDomain($model);
    }

    private function toDomain(CategoryModel $model): Category
    {
        Log::info('toDomain model id:', ['id' => $model->id]);
        return new Category($model->name, $model->id);
    }
}
