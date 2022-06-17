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

        Product::factory()->count(200)->create();

        for ($i = 1; $i <= 50; $i++) {
            Product::factory()->count(1)->create(['name' => "Product $i"]);
        }
    }
}
