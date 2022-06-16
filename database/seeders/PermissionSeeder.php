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
        $menus = ["users", "products", "customers", 'sales', "roles", "permissions",];
        $actions = ['index', 'create', 'edit', 'delete'];

        // dashboard permissions
        foreach ([
            ['name' => "dashboard"],
            ['name' => "dashboard.sales_stats_today"],
            ['name' => 'dashboard.sales_stats_7_days'],
            ['name' => "dashboard.best_selling_products"],
            ['name' => "dashboard.product_stocks"]
        ] as $permission) {
            Permission::create($permission);
        }


        // other menus 
        foreach ($menus as $menu) {
            foreach ($actions as $action) {
                Permission::create([
                    "name" => $menu . "." . $action,
                ]);
            }
        }
    }
}
