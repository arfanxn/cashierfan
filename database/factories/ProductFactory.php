<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $table->id();
        // $table->string("barcode", 100)->unique();
        // $table->string("name", 100);
        // $table->text("description")->nullable();
        // $table->string("image");
        // $table->unsignedTinyInteger("tax_percentage")->default(0);
        // $table->decimal("tax", 10)->default(0);
        // $table->unsignedTinyInteger("profit_percentage")->default(0);
        // $table->decimal("profit", 10);
        // $table->decimal("gross_price", 10);
        // $table->decimal("net_price", 10);
        // $table->unsignedInteger("stock");
        // $table->timestampsTz();

        $images = Storage::disk("public")->allFiles('products/images');

        $grossPrice = rand(1000 * 100, 1000 * 1000);
        $taxPercentage = rand(1, 5);
        $tax = ($grossPrice / 100) * $taxPercentage;
        $profitPercentage = rand(5, 10);
        $profit = ($grossPrice / 100) * $profitPercentage;

        $productName = ucwords($this->faker->words(rand(1, 4), true));

        return [
            "barcode" => strtoupper(Str::random()),
            "name" => $productName,
            "description" => $this->faker->sentences(2, true),
            "image" => "/storage/" . $images[rand(0, count($images) - 1)],
            "tax_percentage" => $taxPercentage,
            "tax" => $tax,
            "profit_percentage" => $profitPercentage,
            "profit" => $profit,
            "gross_price" => $grossPrice,
            "net_price" =>  $grossPrice  + $profit + $tax,
            "stock" => rand(10, 200),
            "deleted_at" => rand(0, 1) ? null : now(),
        ];
    }
}
