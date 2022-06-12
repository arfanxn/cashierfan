<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 300; $i++) {
            Product::factory()->count(1)->create(['name' => "Product $i"]);
        }

        Product::factory()->count(100)->create();
    }
}
