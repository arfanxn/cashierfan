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

        foreach ($menus as $menu) {
            foreach ($actions as $action) {
                Permission::create([
                    "name" => $menu . "." . $action,
                ]);
            }
        }
    }
}
