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
        //  $table->id();
        // $table->string('invoice', 100)->unique();
        // $table->foreignId('cashier_id')->constrained("users", "id");
        // $table->foreignId('customer_id')->constrained("customers", "id");
        // $table->decimal('customer_pay_money', 10);
        // $table->decimal('customer_change_money', 10);
        // $table->decimal('discount', 10)->default(0);
        // $table->decimal('sum_tax', 10)->default(0);
        // $table->decimal('sum_profit', 10);
        // $table->decimal('sum_gross_price', 10);
        // $table->decimal('sum_net_price', 10);
        // $table->timestampTz("created_at");

        $sumGrossPrice = rand(1000 * 1000, 1000 * 10000000);
        $sumTax = ($sumGrossPrice / 100) * rand(1, 5); // get 3 percent of sumGrossPrice
        $sumProfit = ($sumGrossPrice / 100) * rand(3, 10);
        $discount = rand(0, 1) ? 0 : rand(1000 * 100, 1000 * 1000);

        // (sumGrossPrice + profit + sum_tax) and then subtract the result with discount to calculate the sumNetPrice 
        $sumNetPrice = ($sumGrossPrice +  $sumProfit + $sumTax) - $discount;

        $customerPayMoney = rand(0, 1) ? $sumNetPrice : ($sumNetPrice + rand(1000 * 1, 1000 * 100)/**/);
        $customerChangeMoney = $customerPayMoney > $sumNetPrice ? ($customerPayMoney - $sumNetPrice) : 0;

        return [
            "invoice" => strtoupper(Str::random()),
            "cashier_id" => rand(1, 50),
            "customer_id" => rand(1, 100),
            "customer_pay_money" => $customerPayMoney,
            "customer_change_money" => $customerChangeMoney,
            "discount" => $discount,
            "sum_tax" => $sumTax,
            "sum_profit" => $sumProfit,
            "sum_gross_price" => $sumGrossPrice,
            "sum_net_price" => $sumNetPrice,
            "created_at" => now()->subDays(rand(1, 10)),
        ];
    }
}
