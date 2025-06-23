<?php

namespace Tests\Feature\GraphQL;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Infrastructure\Models\CategoryModel;

class ProductMutationTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_product_mutation_returns_product_with_category()
    {
        $category = CategoryModel::create(['name' => 'Test Category']);

        $mutation = '
        mutation {
            createProduct(input: {
                name: "Producto test"
                description: "Desc test"
                price: 19.99
                category_id: ' . $category->id . '
            }) {
                id
                name
                price
                description
                category { id name }
            }
        }
    ';

        $response = $this->postJson('/graphql', [
            'query' => $mutation
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'createProduct' => [
                        'name' => 'Producto test',
                        'price' => 19.99,
                        'description' => 'Desc test',
                        'category' => [
                            'id' => (string) $category->id,
                            'name' => 'Test Category',
                        ]
                    ]
                ]
            ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Producto test',
            'category_id' => $category->id,
        ]);
    }

    public function test_update_product_mutation_returns_product_with_category()
    {
        $category = CategoryModel::create(['name' => 'Cat1']);
        $newCategory = CategoryModel::create(['name' => 'Cat2']);

        // Primero crea un producto
        $product = \App\Infrastructure\Models\ProductModel::create([
            'name' => 'Original',
            'description' => 'Desc original',
            'price' => 10,
            'category_id' => $category->id,
        ]);

        $mutation = '
        mutation {
            updateProduct(id: ' . $product->id . ', input: {
                name: "Producto actualizado"
                price: 99.99
                category_id: ' . $newCategory->id . '
            }) {
                id
                name
                price
                category { id name }
            }
        }
    ';

        $response = $this->postJson('/graphql', [
            'query' => $mutation
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'updateProduct' => [
                        'id' => (string) $product->id,
                        'name' => 'Producto actualizado',
                        'price' => 99.99,
                        'category' => [
                            'id' => (string) $newCategory->id,
                            'name' => 'Cat2',
                        ],
                    ]
                ]
            ]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Producto actualizado',
            'price' => 99.99,
            'category_id' => $newCategory->id,
        ]);
    }

    public function test_delete_product_mutation_deletes_product()
    {
        $category = CategoryModel::create(['name' => 'Test Category']);

        // Crea un producto de prueba
        $product = \App\Infrastructure\Models\ProductModel::create([
            'name' => 'Producto a eliminar',
            'description' => 'Desc',
            'price' => 50.00,
            'category_id' => $category->id,
        ]);

        $mutation = '
        mutation {
            deleteProduct(id: ' . $product->id . ')
        }
    ';

        $response = $this->postJson('/graphql', [
            'query' => $mutation
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'deleteProduct' => true
                ]
            ]);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }
}
