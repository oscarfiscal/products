<?php

namespace Tests\Unit\Application\Services;

use Tests\TestCase;
use App\Application\Services\ProductService;
use App\Domain\Repositories\ProductRepositoryInterface;
use App\Domain\Entities\Product;
use App\Domain\ValueObjects\Price;
use Mockery;

class ProductServiceTest extends TestCase
{
    public function test_create_product_calls_repository_and_returns_product()
    {

        $repositoryMock = Mockery::mock(ProductRepositoryInterface::class);

        $expectedProduct = new Product(
            'Test product',
            'Test description',
            new Price(99.99),
            1,
            5
        );

        $repositoryMock
            ->shouldReceive('create')
            ->once()
            ->andReturn($expectedProduct);

        $service = new ProductService($repositoryMock);

        $product = $service->createProduct(
            new Product('Test product', 'Test description', new Price(99.99), 1)
        );

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Test product', $product->name());
        $this->assertEquals(99.99, $product->price()->amount());
        $this->assertEquals(5, $product->id());
    }

    public function test_update_product_calls_repository_and_returns_product()
    {
        $repositoryMock = Mockery::mock(ProductRepositoryInterface::class);

        $updatedProduct = new Product(
            'Updated name',
            'Updated description',
            new Price(75.00),
            2,
            7
        );

        $repositoryMock
            ->shouldReceive('update')
            ->once()
            ->withArgs(function ($product) {
                return $product instanceof Product && $product->name() === 'Updated name';
            })
            ->andReturn($updatedProduct);

        $service = new ProductService($repositoryMock);


        $result = $service->updateProduct($updatedProduct);

        $this->assertInstanceOf(Product::class, $result);
        $this->assertEquals('Updated name', $result->name());
        $this->assertEquals(75.00, $result->price()->amount());
        $this->assertEquals(7, $result->id());
    }

    public function test_delete_product_calls_repository()
    {
        $repositoryMock = Mockery::mock(ProductRepositoryInterface::class);

        $repositoryMock
            ->shouldReceive('delete')
            ->once()
            ->with(7);

        $service = new ProductService($repositoryMock);

        $service->deleteProduct(7);

        $this->assertTrue(true);
    }

    public function test_list_products_returns_array_of_products()
    {

        $repositoryMock = Mockery::mock(ProductRepositoryInterface::class);

        $products = [
            new Product('Prod 1', 'Desc 1', new Price(10), 1, 1),
            new Product('Prod 2', 'Desc 2', new Price(20), 2, 2),
        ];

        $repositoryMock
            ->shouldReceive('findAll')
            ->once()
            ->andReturn($products);


        $service = new ProductService($repositoryMock);


        $result = $service->listProducts();


        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertInstanceOf(Product::class, $result[0]);
    }

    public function test_get_product_by_id_returns_product()
    {

        $repositoryMock = Mockery::mock(ProductRepositoryInterface::class);

        $product = new Product('Prod', 'Desc', new Price(50), 1, 10);

        $repositoryMock
            ->shouldReceive('findById')
            ->with(10)
            ->once()
            ->andReturn($product);


        $service = new ProductService($repositoryMock);


        $result = $service->getProduct(10);

        $this->assertInstanceOf(Product::class, $result);
        $this->assertEquals(10, $result->id());
    }

    public function test_list_products_by_category_returns_products()
    {
        // Arrange
        $repositoryMock = Mockery::mock(ProductRepositoryInterface::class);

        $products = [
            new Product('Prod Cat', 'Desc', new Price(30), 2, 5),
        ];

        $repositoryMock
            ->shouldReceive('findByCategory')
            ->with(2)
            ->once()
            ->andReturn($products);

        $service = new ProductService($repositoryMock);

        // Act
        $result = $service->listProductsByCategory(2);

        // Assert
        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->assertEquals(2, $result[0]->categoryId());
    }
}
