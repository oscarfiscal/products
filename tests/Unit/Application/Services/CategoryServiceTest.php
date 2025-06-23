<?php

namespace Tests\Unit\Application\Services;

use Tests\TestCase;
use App\Application\Services\ProductService;
use App\Domain\Repositories\ProductRepositoryInterface;
use App\Domain\Entities\Product;
use App\Domain\ValueObjects\Price;
use Mockery;

class CategoryServiceTest extends TestCase
{
    public function test_create_category_calls_repository_and_returns_category()
    {
        $repositoryMock = \Mockery::mock(\App\Domain\Repositories\CategoryRepositoryInterface::class);

        $expectedCategory = new \App\Domain\Entities\Category('Test Category', 1);

        $repositoryMock
            ->shouldReceive('create')
            ->once()
            ->andReturn($expectedCategory);

        $service = new \App\Application\Services\CategoryService($repositoryMock);

        $category = $service->createCategory(
            new \App\Domain\Entities\Category('Test Category')
        );

        $this->assertInstanceOf(\App\Domain\Entities\Category::class, $category);
        $this->assertEquals('Test Category', $category->name());
        $this->assertEquals(1, $category->id());
    }
    public function test_update_category_calls_repository_and_returns_category()
    {
        $repositoryMock = \Mockery::mock(\App\Domain\Repositories\CategoryRepositoryInterface::class);

        $updatedCategory = new \App\Domain\Entities\Category('Updated Category', 2);

        $repositoryMock
            ->shouldReceive('update')
            ->once()
            ->andReturn($updatedCategory);

        $service = new \App\Application\Services\CategoryService($repositoryMock);

        $category = $service->updateCategory($updatedCategory);

        $this->assertInstanceOf(\App\Domain\Entities\Category::class, $category);
        $this->assertEquals('Updated Category', $category->name());
        $this->assertEquals(2, $category->id());
    }
    public function test_list_categories_returns_array_of_categories()
    {
        $repositoryMock = \Mockery::mock(\App\Domain\Repositories\CategoryRepositoryInterface::class);

        $categories = [
            new \App\Domain\Entities\Category('Cat1', 1),
            new \App\Domain\Entities\Category('Cat2', 2),
        ];

        $repositoryMock
            ->shouldReceive('findAll')
            ->once()
            ->andReturn($categories);

        $service = new \App\Application\Services\CategoryService($repositoryMock);

        $result = $service->listCategories();

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertInstanceOf(\App\Domain\Entities\Category::class, $result[0]);
    }
    public function test_get_category_by_id_returns_category()
    {
        $repositoryMock = \Mockery::mock(\App\Domain\Repositories\CategoryRepositoryInterface::class);

        $category = new \App\Domain\Entities\Category('Cat', 10);

        $repositoryMock
            ->shouldReceive('findById')
            ->with(10)
            ->once()
            ->andReturn($category);

        $service = new \App\Application\Services\CategoryService($repositoryMock);

        $result = $service->getCategory(10);

        $this->assertInstanceOf(\App\Domain\Entities\Category::class, $result);
        $this->assertEquals(10, $result->id());
    }
}
