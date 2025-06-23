<?php

namespace Database\Seeders;

use App\Infrastructure\Models\ProductModel;
use App\Infrastructure\Models\CategoryModel;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $electronics = CategoryModel::firstOrCreate(['name' => 'Electrónica']);
        $clothing    = CategoryModel::firstOrCreate(['name' => 'Ropa']);
        $books       = CategoryModel::firstOrCreate(['name' => 'Libros']);

        $products = [
            [
                'name' => 'Smartphone X',
                'description' => 'Teléfono de última generación',
                'price' => 899.99,
                'category_id' => $electronics->id,
            ],
            [
                'name' => 'Camiseta básica',
                'description' => '100% algodón, varios colores',
                'price' => 19.99,
                'category_id' => $clothing->id,
            ],
            [
                'name' => 'Libro DDD',
                'description' => 'Domain-Driven Design en profundidad',
                'price' => 34.90,
                'category_id' => $books->id,
            ],
        ];

        foreach ($products as $product) {
            ProductModel::create($product);
        }
    }
}
