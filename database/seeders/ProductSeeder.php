<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'Tomato Seeds',
                'description' => 'High-quality tomato seeds for home gardening.',
                'price' => 49.99,
                'image_url' => 'images/tomatoSeed.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Garden Shovel',
                'description' => 'Durable shovel for planting and digging.',
                'price' => 199.00,
                'image_url' => 'images/gardenShovel.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Organic Fertilizer',
                'description' => 'Perfect blend for healthy and fast-growing plants.',
                'price' => 299.50,
                'image_url' => 'images/organicFertilizer.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
               [
                'name' => 'Bellpepper Seeds',
                'description' => 'Easy to grow bellpepper seeds, perfect for your home garden.',
                'price' => 49.99,
                'image_url' => 'images/bellpepperSeeds.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
               [
                'name' => 'Set of Garden Tools in Blue',
                'description' => 'Great for beginners and experienced gardeners alike, this set includes a trowel, pruner, and rake.',
                'price' => 500.00,
                'image_url' => 'images/gardenSet1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
               [
                'name' => 'Liquid Fertilizer',
                'description' => 'Our highest quality fertilizer, now in liquid form for easy application.',
                'price' => 310.50,
                'image_url' => 'images/liquidFertilizer.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
