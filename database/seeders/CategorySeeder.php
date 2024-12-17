<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Pendidikan', 'slug_categories' => 'Pendidkan', 'color' => 'green'],
            ['name' => 'Pembangunan', 'slug_categories' => 'Pembagunan', 'color' => 'yellow'],
        ];

        foreach($categories as $category){
            Category::create([
                'name' => $category['name'],
                'slug_categories' => $category['slug_categories'],
                'color' => $category['color']
            ]);
        }
    }
}
