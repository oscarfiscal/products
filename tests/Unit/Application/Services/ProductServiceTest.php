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
        // Arrange
        $repositoryMock = Mockery::mock(ProductRepositoryInterface::class);

        $expectedProduct = new Product(
            'Test product',
            'Test description',
            new Price(99.99),
            1,
            5 // el id que normalmente asigna la base de datos
        );

        // Simula que el repositorio retorna el producto creado
        $repositoryMock
            ->shouldReceive('create')
            ->once()
            ->andReturn($expectedProduct);

        $service = new ProductService($repositoryMock);

        // Act
        $product = $service->createProduct(
            new Product('Test product', 'Test description', new Price(99.99), 1)
        );

        // Assert
        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Test product', $product->name());
        $this->assertEquals(99.99, $product->price()->amount());
        $this->assertEquals(5, $product->id());
    }
}
