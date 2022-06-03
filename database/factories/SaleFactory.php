<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        /*  $table->id();
        $table->string('invoice', 100);
        $table->foreignId('cashier_id')->constrained("users", "id");
        $table->foreignId('customer_id')->constrained("customers", "id");
        $table->decimal('customer_pay_money', 10);
        $table->decimal('customer_change_money', 10);
        $table->decimal('discount', 10)->default(0);
        $table->decimal('tax', 10)->default(0);
        $table->decimal('sum_gross_price', 10);
        $table->decimal('sum_net_price', 10);
        $table->decimal('sum_profit', 10);
        $table->timestamp("created_at");
        */

        $sumGrossPrice = rand(1000 * 1000, 1000 * 10000);
        $tax = ($sumGrossPrice / 100) * 5; // get 5 percent of sumGrossPrice
        $sumProfit = rand(1000 * 200, 1000 * 2000);
        $discount = rand(0, 1) ? 0 : rand(1000 * 10, 1000 * 20);

        // (sumGrossPrice + profit + tax) and then subtract the result with discount to calculate the sumNetPrice 
        $sumNetPrice = ($sumGrossPrice +  $sumProfit + $tax) - $discount;

        $customerPayMoney = rand(0, 1) ? $sumNetPrice : ($sumNetPrice + rand(1000 * 1, 1000 * 100)/**/);
        $customerChangeMoney = $customerPayMoney > $sumNetPrice ?  0  : ($customerPayMoney - $sumNetPrice);

        return [
            "invoice" => Str::random(),
            // cashier_id is passed through parameters . 
            "customer_id" => rand(1, 50),
            "customer_pay_money" => $customerPayMoney,
            "customer_change_money" => $customerChangeMoney,
            "discount" => $discount,
            "tax" => $tax,
            "sum_gross_price" => $sumGrossPrice,
            "sum_net_price" => $sumNetPrice,
            "sum_profit" => $sumProfit,
            "created_at" => now(),
        ];
    }
}
