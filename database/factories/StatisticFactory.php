<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Statistic>
 */
class StatisticFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // "statisticable_id" =>  pass by argument
            // "statisticable_type" =>  pass by argument
            // "key" => pass by argument
            "value" => rand(1, 1000),
            "created_at" => now(),
            "updated_at" => now(),
        ];
    }
}
