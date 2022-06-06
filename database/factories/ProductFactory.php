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
        /*  
            $table->id();
            $table->string("code", 100);
            $table->string("name", 100);
            $table->text("description")->nullable();
            $table->string("image")->nullable();
            $table->decimal("gross_price", 10);
            $table->decimal("net_price", 10);
            $table->decimal("profit", 10);
            $table->string("stock");
            $table->timestamp("created_at");
        */
        $images = Storage::disk("public")->allFiles('products/images');

        $grossPrice = rand(1000 * 100, 1000 * 1000);
        $profit = rand(1000 * 20, 1000 * 200);

        $productName = ucwords($this->faker->words(rand(1, 4), true));

        return [
            "barcode" => Str::random(),
            "name" => $productName,
            "description" => $this->faker->sentences(2, true),
            "image" => "/storage/" . $images[rand(0, count($images) - 1)],
            "gross_price" => $grossPrice,
            "net_price" =>  $grossPrice  + $profit,
            "profit" => $profit,
            "stock" => rand(1, 100),
        ];
    }
}
