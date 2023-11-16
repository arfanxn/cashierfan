<?php

namespace Database\Seeders;

use App\Models\ProductSale;
use App\Models\Sale;
use App\Models\Product;
use App\Repositories\StatisticRepository;
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
        Sale::factory()->count(100)->create()->each(function ($sale) {
            ProductSale::factory()->count(rand(1, 100))
                ->create([
                    "sale_id" => $sale->id,
                ])->each(function ($productSale) {
                    StatisticRepository::write([
                        "type" => Product::class,
                        "id" => $productSale->product_id,
                        "key" => "best_selling_products",
                        "value" =>  $productSale->quantity,
                    ]);
                });

            $date = today()->subDays(rand(0, 10))->startOfDay();

            StatisticRepository::write([
                "type" => Sale::class,
                "key" => "sales_happening_count",
                "value" =>  1,
                "date" => $date
            ]);

            StatisticRepository::write([
                "type" => Sale::class,
                "key" => "sales_grosses",
                "value" =>  $sale->sum_gross_price,
                "date" => $date
            ]);
            StatisticRepository::write([
                "type" => Sale::class,
                "key" => "sales_profits",
                "value" =>  $sale->sum_profit,
                "date" => $date
            ]);
            StatisticRepository::write([
                "type" => Sale::class,
                "key" => "sales_taxes",
                "value" =>  $sale->sum_tax,
                "date" => $date
            ]);
        });
    }
}
