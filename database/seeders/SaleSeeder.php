<?php

namespace Database\Seeders;

use App\Actions\MakeSaleAction;
use App\Models\ProductSale;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
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
        // Sale::factory()->count(100)->create(
        //     [
        //         "cashier_id" => 1,
        //     ]
        // )->each(function ($sale) {
        //     ProductSale::factory()->count(rand(1, 25))
        //         ->create([
        //             "sale_id" => $sale->id,
        //         ]);
        // });

        $cashiers = User::limit(10)->get();

        $cutomers = Customer::limit(20)->get();

        $products = Product::limit(50)->get();

        for ($i = 0; $i < 100; $i++) {
            $cashier  = $cashiers[rand(0, 9)];
            $cutomer  = $cutomers[rand(0, 19)];

            $selectedProducts = array_filter($products->toArray(), fn () => rand(0, 1));

            $selectedProducts = array_map(function ($product) {
                return array_merge($product, ['quantity' => rand(1, 3)]);
            }, $selectedProducts);

            MakeSaleAction::exec($cashier, $cutomer, 99999999999.00, rand(0, 20000), $selectedProducts);
        }
    }
}
