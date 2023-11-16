<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\VerificationCodeService;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create("id_ID");

        \App\Models\User::factory()->create([
            'name' => 'Arfan',
            'email' => 'arf@gm.com',
            "password" => bcrypt(11112222),
        ])->each(function (User $user) {
            VerificationCodeService::make($user->email)->fresh();

            $user->assignRole(Role::where("name", "ROOT")->first());

            \App\Models\UserDetail::factory()->create([
                "user_id" => $user->id,
                "avatar" => Storage::disk("public")->allFiles("users/avatars"),
            ]);
        });

        \App\Models\User::factory(99)->create([
            'password' => bcrypt(11112222)
        ])->each(function (User $user) {
            VerificationCodeService::make($user->email)->fresh();

            $user->assignRole(
                Role::where("id", rand(2, 9))->first()
            );
            \App\Models\UserDetail::factory()->create([
                "user_id" => $user->id,
            ]);
        });
    }
}
