<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // * dashboard
            ["guard_name" => "web", 'name' => "dashboard"],
            ["guard_name" => "web", 'name' => "dashboard.sales_stats_today"],
            ["guard_name" => "web", 'name' => 'dashboard.sales_stats_7_days'],
            ["guard_name" => "web", 'name' => "dashboard.best_selling_products"],
            ["guard_name" => "web", 'name' => "dashboard.product_stocks"],

            // * customers
            ["guard_name" => "web", 'name' => "customers.index"],
            ["guard_name" => "web", 'name' => 'customers.create'],
            ["guard_name" => "web", 'name' => "customers.edit"],
            ["guard_name" => "web", 'name' => "customers.delete"],

            // * products
            ["guard_name" => "web", 'name' => "products.index"],
            ["guard_name" => "web", 'name' => 'products.create'],
            ["guard_name" => "web", 'name' => "products.edit"],
            ["guard_name" => "web", 'name' => "products.delete"],

            // * sales
            ["guard_name" => "web", 'name' => "sales.index"],
            ["guard_name" => "web", 'name' => "sales.profit_index"],
            ["guard_name" => "web", 'name' => "sales.show"],
            ["guard_name" => "web", 'name' => 'sales.create'],

            // * roles
            ["guard_name" => "web", 'name' => "roles.index"],
            ["guard_name" => "web", 'name' => 'roles.create'],
            ["guard_name" => "web", 'name' => "roles.edit"],
            ["guard_name" => "web", 'name' => "roles.delete"],

            // * permissions
            ["guard_name" => "web", 'name' => "permissions.index"],

            // * users
            ["guard_name" => "web", 'name' => "users.index"],
            ["guard_name" => "web", 'name' => 'users.create'],
            ["guard_name" => "web", 'name' => "users.edit"],
            ["guard_name" => "web", 'name' => "users.delete"],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
