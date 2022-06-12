<?php

namespace App\Actions;

use App\Helpers\Redirect;
use App\Helpers\Str;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MakeSaleAction
{
    public static function exec(
        $cashier,
        $customer = null,
        float $customerPayMoney,
        float $discount = 0.00,
        array $products = []
    ) {
        // if customer is null get the "general" customer  (just buyer with no name) 
        $customer = $customer ? $customer : Customer::where("id", 1)->first();

        $sumTax = 0.00;
        $sumProfit = 0.00;
        $sumGrossPrice = 0.00;
        $sumNetPrice = 0.00;

        $product_sale = array_map(function ($product) use (
            $sumTax,
            $sumProfit,
            $sumGrossPrice,
        ) {
            $sumTax = $sumTax + ($product['tax'] * $product['quantity']);
            $sumProfit = $sumProfit + ($product['profit'] * $product['quantity']);
            $sumGrossPrice = $sumGrossPrice + ($product['gross_price'] * $product['quantity']);

            return collect($product)->only([
                "tax_percentage",
                "tax",
                "profit_percentage",
                "profit",
                "quantity",
                "gross_price",
                "net_price",
            ])->merge([
                "product_id" => $product['id'],
                "sum_tax" => ($product['tax'] * $product['quantity']),
                "sum_profit" => ($product['profit'] * $product['quantity']),
                "sum_gross_price" => ($product['gross_price'] * $product['quantity']),
                "sum_net_price" => ($product['net_price'] * $product['quantity']),
            ])->toArray();
        }, $products);

        // if discount set -> net_price subract by discount 
        if ($discount > 0) {
            $sumNetPrice = ($sumTax + $sumProfit + $sumGrossPrice) - $discount;
        } else { //otherwise 
            $sumNetPrice = ($sumTax + $sumProfit + $sumGrossPrice);
        }

        // get the customer pay money change 
        $customerChangeMoney = $customerPayMoney - $sumNetPrice;


        try {
            DB::beginTransaction();

            // create the sale
            $insertedSaleID = Sale::insertGetId([
                "invoice" => strtoupper(Str::random()),
                "cashier_id" => $cashier['id'],
                "customer_id" => $customer['id'],
                "customer_pay_money" => $customerPayMoney,
                'customer_change_money' => $customerChangeMoney,
                "discount" => $discount,
                'sum_tax' => $sumTax,
                'sum_profit' => $sumProfit,
                'sum_gross_price' => $sumGrossPrice,
                'sum_net_price' => $sumNetPrice,
                "created_at" => now(),
            ]);
            $sale = Sale::where("id", $insertedSaleID)->first();

            // create the relation products at sale;
            $product_sale = array_map(
                fn ($product) => array_merge($product, ['sale_id' => $insertedSaleID]),
                $product_sale
            );

            $products = $sale->products()->insert($product_sale);

            DB::commit();

            return [
                "sale" => $sale,
                "products" => $products,
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            return Redirect::now(
                redirect()->back()->withErrors(['sales.store' => $th])
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::now(redirect()->back()->withErrors(
                ['sales.store' => "Something went wrong"]
            ));
        }
    }
}
