<?php

namespace Database\Seeders;

use App\Actions\MakeSaleAction;
use App\Models\ProductSale;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use App\Repositories\StatisticRepository;
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
        Sale::factory()->count(100)->create()->each(function ($sale) {
            ProductSale::factory()->count(rand(1, 25))
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

        // $cashiers = User::limit(10)->get();

        // $cutomers = Customer::limit(20)->get();

        // $products = Product::limit(50)->get();

        // for ($i = 0; $i < 100; $i++) {
        //     $cashier  = $cashiers[rand(0, 9)];
        //     $cutomer  = $cutomers[rand(0, 19)];

        //     $selectedProducts = array_filter($products->toArray(), fn () => rand(0, 1));

        //     $selectedProducts = array_map(function ($product) {
        //         return array_merge($product, ['quantity' => rand(1, 3)]);
        //     }, $selectedProducts);

        //     MakeSaleAction::exec($cashier, $cutomer, 99999999999.00, rand(0, 20000), $selectedProducts);
        // }
    }
}
