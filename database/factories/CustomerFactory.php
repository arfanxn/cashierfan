<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        /*  $table->id();
            $table->string("name", 100);
            $table->string("phone_number", 30)->nullable();
            $table->string("address")->nullable();
            $table->timestamps();
        */

        return [
            "name" => $this->faker->name(),
            "phone_number" => $this->faker->phoneNumber(),
            "address" => $this->faker->address(),
        ];
    }
}
