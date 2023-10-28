<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::unguard();
        Product::create([
            'name' => 'Test Product',
            'description' => 'Test Product Description',
            'price' => 100,
            'category' => 1,
            'product_type' => 1,
            'quantity' => 1,
            'img' => '',
        ]);
        Product::create([
            'name' => 'Test Product 2',
            'description' => 'Test Product Description 2',
            'price' => 200,
            'category' => 2,
            'product_type' => 2,
            'quantity' => 2,
            'img' => '',
        ]);
        Product::reguard();
    }
}
