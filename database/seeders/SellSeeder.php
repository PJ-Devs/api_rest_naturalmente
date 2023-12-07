<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sell;

class SellSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sell::unguard();
            Sell::create([
                'user_id' => 2,
                'total_price' => 1000,
                'status' => 'pending'
            ]);

            Sell::create([
                'user_id' => 3,
                'total_price' => 2000,
                'status' => 'pending'
            ]);

            Sell::create([
                'user_id' => 4,
                'total_price' => 3000,
                'status' => 'pending'
            ]);

            Sell::create([
                'user_id' => 2,
                'total_price' => 3400,
                'status' => 'pending'
            ]);

            Sell::create([
                'user_id' => 3,
                'total_price' => 2100,
                'status' => 'pending'
            ]);
        Sell::reguard();
    }
}
