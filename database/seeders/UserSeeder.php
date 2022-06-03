<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

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
            'name' => 'Muhammad Arfan',
            'email' => 'arf@gm.com',
            "password" => bcrypt(11112222),
        ])->each(function (User $user) {
            $user->assignRole("Admin");
            $user->syncPermissions(Permission::all("name")->pluck("name"));
            \App\Models\UserDetail::factory()->create([
                "user_id" => $user->id,
            ]);
        });

        \App\Models\User::factory(20)->create()->each(function ($user) {
            $user->assignRole('Employee');
            \App\Models\UserDetail::factory()->create([
                "user_id" => $user->id,
            ]);
        });
    }
}
