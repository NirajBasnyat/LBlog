<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'is_active' => 1
            ],

            [
                'name' => 'Entertainment',
                'slug' => 'entertainment',
                'is_active' => 1
            ],

            [
                'name' => 'Informative',
                'slug' => 'informative',
                'is_active' => 1
            ],

            [
                'name' => 'Food Science',
                'slug' => 'food-science',
                'is_active' => 0
            ],

            [
                'name' => 'Art and Crafts',
                'slug' => 'art-and-crafts',
                'is_active' => 0
            ],
        ];

        \DB::table('categories')->insert($categories);
    }
}
