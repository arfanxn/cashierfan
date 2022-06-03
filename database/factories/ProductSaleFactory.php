<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductSale>
 */
class ProductSaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        /*  $table->id();
            $table->foreignId("sale_id")->constrained("sales", "id")->onDelete("cascade");
            $table->foreignId("product_id")->constrained("products", "id")->onDelete("cascade");
            $table->decimal('gross_price', 10);
            $table->decimal('net_price', 10);
            $table->decimal('profit', 10);
            $table->unsignedInteger("quantity")->default(1);
            $table->decimal('sum_gross_price', 10);
            $table->decimal('sum_net_price', 10);
            $table->decimal('sum_profit', 10);
        */
        $grossPrice = rand(1000 * 100, 1000 * 1000);
        $profit = rand(1000 * 20, 1000 * 200);
        $quantity = rand(1, 20);
        $sumGrossPrice = (rand(1000 * 100, 1000 * 1000)) * $quantity;
        $sumProfit = $profit + $quantity;
        $sumNetPrice =  $sumProfit + $sumGrossPrice;

        return [
            // sale_id , xxxproduct_idxxx are passed through parameters .
            "product_id" => rand(1, 50),
            "gross_price" => $grossPrice,
            "net_price" =>  $grossPrice  + $profit,
            "profit" => $profit,
            "quantity" => $quantity,
            "sum_gross_price" => $sumGrossPrice,
            "sum_net_price" => $sumNetPrice,
            "sum_profit" => $sumProfit,
        ];
    }
}
