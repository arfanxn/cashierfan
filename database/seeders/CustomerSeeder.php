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

        Customer::factory()->count(200)->create();

        for ($i = 1; $i <= 50; $i++) {
            Customer::factory()->count(1)->create(['name' => "Customer $i"]);
        }
    }
}
