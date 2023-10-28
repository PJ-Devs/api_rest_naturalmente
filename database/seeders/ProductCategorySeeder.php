<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ProductCategory::unguard();
        ProductCategory::create([
            'name' => 'Test Product Category',
        ]);
        ProductCategory::create([
            'name' => 'Test Product Category 2',
        ]);
        ProductCategory::reguard();
    }
}
