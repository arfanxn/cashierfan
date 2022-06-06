<?php

namespace Database\Factories;

use App\Helpers\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

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
        $avatars = Storage::disk("public")->allFiles('users/avatars');
        $hexColor = "#" . Str::random(6, "0123456789ABCDEF");
        $useAvatar = rand(0, 1);

        return [
            // "user_id" is provided by the paramter 
            "avatar" => $useAvatar ? "/storage/"  . $avatars[rand(0, count($avatars) - 1)/**/] : $hexColor,
            "phone_number" => $this->faker->phoneNumber(),
            "address" => $this->faker->address(),
        ];
    }
}
