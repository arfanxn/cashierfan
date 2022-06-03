<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        $grossPrice = rand(1000 * 100, 1000 * 1000);
        $profit = rand(1000 * 20, 1000 * 200);

        return [
            "code" => Str::random(),
            "name" => $this->faker->name(),
            "description" => $this->faker->sentences(2, true),
            "image" => null,
            "gross_price" => $grossPrice,
            "net_price" =>  $grossPrice  + $profit,
            "profit" => $profit,
            "stock" => rand(1, 100),
        ];
    }
}
