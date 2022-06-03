<?php

namespace Database\Seeders;

use App\Models\ProductSale;
use App\Models\Sale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sale::factory()->count(100)->create(
            [
                "cashier_id" => 1,
            ]
        )->each(function ($sale) {
            ProductSale::factory()->count(rand(1, 25))
                ->create([
                    "sale_id" => $sale->id,
                ]);
        });
    }
}
