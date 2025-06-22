<?php

namespace Database\Seeders;

use App\Infrastructure\Models\ProductModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $products = [
            [
                'name' => 'Smartphone X',
                'description' => 'Teléfono de última generación',
                'price' => 899.99,
                'category_id' => 1,
            ],
            [
                'name' => 'Camiseta básica',
                'description' => '100% algodón, varios colores',
                'price' => 19.99,
                'category_id' => 2,
            ],
            [
                'name' => 'Libro DDD',
                'description' => 'Domain-Driven Design en profundidad',
                'price' => 34.90,
                'category_id' => 3,
            ],
        ];

        foreach ($products as $product) {
            ProductModel::create($product);
        }
    }
}
