<?php

namespace Database\Seeders;

use App\Infrastructure\Models\CategoryModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Electrónica'],
            ['name' => 'Ropa'],
            ['name' => 'Libros'],
        ];

        foreach ($categories as $category) {
            CategoryModel::create($category);
        }
    }
}
