<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::factory()->count(1)->create([
            "name" => 'General',
            "phone_number" => null,
            "address" => null,
        ]);

        for ($i = 1; $i <= 300; $i++) {
            Customer::factory()->count(1)->create(['name' => "Customer $i"]);
        }

        Customer::factory()->count(100)->create();
    }
}
