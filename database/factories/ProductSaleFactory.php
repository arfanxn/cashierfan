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
        // $table->id();
        // $table->foreignId("sale_id")->constrained("sales", "id")->onDelete("cascade");
        // $table->foreignId("product_id")->constrained("products", "id")->onDelete("cascade");

        // $table->unsignedTinyInteger("tax_percentage")->default(0);
        // $table->decimal("tax", 10)->default(0);
        // $table->unsignedTinyInteger("profit_percentage")->default(0);
        // $table->decimal("profit", 10);
        // $table->decimal("gross_price", 10);
        // $table->decimal("net_price", 10);

        // $table->unsignedInteger("quantity")->default(1);
        // $table->decimal('sum_tax', 10)->default(0);
        // $table->decimal('sum_profit', 10);
        // $table->decimal('sum_gross_price', 10);
        // $table->decimal('sum_net_price', 10);

        $grossPrice = rand(1000 * 100, 1000 * 1000);
        
        $taxPercentage = 3;
        $tax = ($grossPrice / 100) * $taxPercentage;
        $profitPercentage = 5;
        $profit = ($grossPrice / 100) * $profitPercentage;

        $quantity = rand(1, 90);

        $sumTax = $tax * $quantity;
        $sumProfit = $profit * $quantity;
        $sumGrossPrice = $grossPrice * $quantity;
        $sumNetPrice = $sumGrossPrice + $sumTax + $sumProfit;

        return [
            // sale_id , xxxproduct_idxxx are passed through parameters .
            "product_id" => rand(1, 50),

            "tax_percentage" => $taxPercentage,
            "tax" => $tax,
            "profit_percentage" => $profitPercentage,
            "profit" => $profit,
            "gross_price" => $grossPrice,
            "net_price" =>  $grossPrice  + $profit + $tax,

            "quantity" => $quantity,
            "sum_tax" => $sumTax,
            "sum_profit" => $sumProfit,
            "sum_gross_price" => $sumGrossPrice,
            "sum_net_price" => $sumNetPrice,

        ];
    }
}
