<?php

namespace Database\Factories;

use App\Helpers\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserDetail>
 */
class UserDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // "user_id" is provided by the paramter 
            "avatar" => "#" . Str::random(6, "0123456789ABCDEF"),
            "phone_number" => $this->faker->phoneNumber(),
            "address" => $this->faker->address(),
        ];
    }
}
