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
            'name' => 'Organic Avocado',
            'description' => 'Fresh and organic avocado, rich in healthy fats.',
            'price' => 5000,
            'category' => 1,
            'product_type' => 1,
            'quantity' => 10,
            'img' => 'avocado.jpg',
        ]);

        Product::create([
            'name' => 'Raw Honey',
            'description' => 'Pure and unprocessed honey, sourced from local bee farms.',
            'price' => 15000,
            'category' => 2,
            'product_type' => 2,
            'quantity' => 5,
            'img' => 'honey.jpg',
        ]);

        Product::create([
            'name' => 'Organic Quinoa',
            'description' => 'High-quality organic quinoa, a nutritious grain.',
            'price' => 8000,
            'category' => 1,
            'product_type' => 1,
            'quantity' => 8,
            'img' => 'quinoa.jpg',
        ]);

        Product::create([
            'name' => 'Herbal Tea Sampler',
            'description' => 'A collection of organic herbal teas for relaxation and health benefits.',
            'price' => 25000,
            'category' => 2,
            'product_type' => 1,
            'quantity' => 15,
            'img' => 'herbal_tea.jpg',
        ]);

        Product::create([
            'name' => 'Coconut Oil',
            'description' => 'Cold-pressed and organic coconut oil for cooking and skincare.',
            'price' => 18000,
            'category' => 2,
            'product_type' => 2,
            'quantity' => 7,
            'img' => 'coconut_oil.jpg',
        ]);

        Product::create([
            'name' => 'Natural Lavender Soap',
            'description' => 'Handmade lavender-scented soap with natural ingredients.',
            'price' => 12000,
            'category' => 1,
            'product_type' => 2,
            'quantity' => 12,
            'img' => 'lavender_soap.jpg',
        ]);

        Product::create([
            'name' => 'Organic Almonds',
            'description' => 'Raw and organic almonds for a healthy snack.',
            'price' => 15000,
            'category' => 1,
            'product_type' => 1,
            'quantity' => 5,
            'img' => 'almonds.jpg',
        ]);

        Product::create([
            'name' => 'Aloe Vera Gel',
            'description' => 'Pure aloe vera gel for soothing and moisturizing the skin.',
            'price' => 10000,
            'category' => 2,
            'product_type' => 2,
            'quantity' => 10,
            'img' => 'aloe_vera_gel.jpg',
        ]);
        Product::reguard();
    }
}
