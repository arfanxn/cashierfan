<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // * total roles below are 8
        // having all of permissions
        $ROOT = Role::create(["guard_name" => "web", "name" => "ROOT"]);
        $ROOT->givePermissionTo(Permission::all());

        // admins can't delete roles
        $admin = Role::create(["guard_name" => "web", "name" => "Admin"]);
        $admin->givePermissionTo(
            Permission::whereNot("name", "roles.delete")->get()
        );


        // managers can't create/edit/delete roles
        $manager = Role::create(["guard_name" => "web", "name" => "Manager"]);
        $manager->givePermissionTo(
            Permission::whereNotIn("name", ["roles.create", "roles.edit", "roles.delete"])->get()
        );

        $accountant = Role::create(["guard_name" => "web", "name" => "Accountant"]);
        $accountant->givePermissionTo(
            Permission::whereIn("name", [
                "dashboard",
                "dashboard.sales_stats_today",
                "dashboard.sales_stats_7_days",
                "dashboard.best_selling_products",
                "dashboard.product_stocks",
                "sales.index",
                "sales.profit_index",
                "sales.show",
                "products.index",
            ])->get()
            // ["guard_name" => "web",  "name" => "dashboard"],
            // ["guard_name" => "web",  "name" => "dashboard.sales_stats_today"],
            // ["guard_name" => "web",  "name" => "dashboard.sales_stats_7_days"],
            // ["guard_name" => "web",  "name" => "dashboard.best_selling_products"],
            // ["guard_name" => "web",  "name" => "dashboard.product_stocks"],
            // ["guard_name" => "web",  "name" => "sales.index"],
            // ["guard_name" => "web",  "name" => "sales.profit_index"],
            // ["guard_name" => "web",  "name" => "sales.show"],
            // ["guard_name" => "web",  "name" => "products.index"],
        );

        $businessAnalyst = Role::create(["guard_name" => "web", "name" => "Business Analyst"]);
        $businessAnalyst->givePermissionTo(
            Permission::whereIn("name", [
                "dashboard",
                "dashboard.sales_stats_today",
                "dashboard.sales_stats_7_days",
                "dashboard.best_selling_products",
                "dashboard.product_stocks",
                "sales.index",
                "sales.profit_index",
                "sales.show",
                "products.index",
            ])->get()

            // ["guard_name" => "web",  "name" => "dashboard"],
            // ["guard_name" => "web",  "name" => "dashboard.sales_stats_today"],
            // ["guard_name" => "web",  "name" => "dashboard.sales_stats_7_days"],
            // ["guard_name" => "web",  "name" => "dashboard.best_selling_products"],
            // ["guard_name" => "web",  "name" => "dashboard.product_stocks"],
            // ["guard_name" => "web",  "name" => "sales.index"],
            // ["guard_name" => "web",  "name" => "sales.profit_index"],
            // ["guard_name" => "web",  "name" => "sales.show"],
            // ["guard_name" => "web",  "name" => "products.index"],
        );

        $financialAnalyst = Role::create(["guard_name" => "web", "name" => "Financial Analyst"]);
        $financialAnalyst->givePermissionTo(
            Permission::whereIn("name", [
                "dashboard",
                "dashboard.sales_stats_today",
                "dashboard.sales_stats_7_days",
                "sales.index",
                "sales.profit_index",
                "sales.show",
            ])->get()

            // ["guard_name" => "web",  "name" => "dashboard"],
            // ["guard_name" => "web",  "name" => "dashboard.sales_stats_today"],
            // ["guard_name" => "web",  "name" => "dashboard.sales_stats_7_days"],
            // ["guard_name" => "web",  "name" => "sales.index"],
            // ["guard_name" => "web",  "name" => "sales.profit_index"],
            // ["guard_name" => "web",  "name" => "sales.show"],
        );

        $cashier = Role::create(["guard_name" => "web", "name" => "Cashier"]);
        $cashier->givePermissionTo(
            Permission::whereiN("name", [
                "dashboard",
                "dashboard.best_selling_products",
                "dashboard.product_stocks",

                "customers.index",
                "customers.create",
                "customers.edit",
                "customers.delete",

                "sales.index",
                "sales.create",
                "sales.show",
            ])->get()


            // ["guard_name" => "web",  "name" => "dashboard"],
            // ["guard_name" => "web",  "name" => "dashboard.best_selling_products"],
            // ["guard_name" => "web",  "name" => "dashboard.product_stocks"],

            // ["guard_name" => "web",  "name" => "customers.index"],
            // ["guard_name" => "web",  "name" => "customers.create"],
            // ["guard_name" => "web",  "name" => "customers.edit"],
            // ["guard_name" => "web",  "name" => "customers.delete"],

            // ["guard_name" => "web",  "name" => "sales.index"],
            // ["guard_name" => "web",  "name" => "sales.create"],
            // ["guard_name" => "web",  "name" => "sales.show"],
        );

        $cs = Role::create(["guard_name" => "web", "name" => "Customer Service"]);
        $cs->givePermissionTo(
            Permission::whereIn("name", [
                "dashboard",

                "customers.index",
                "customers.create",
                "customers.edit",
                "customers.delete",

                "sales.index",
                "sales.show",
            ])->get()

            // ["guard_name" => "web",  "name" => "dashboard"],

            // ["guard_name" => "web",  "name" => "customers.index"],
            // ["guard_name" => "web",  "name" => "customers.create"],
            // ["guard_name" => "web",  "name" => "customers.edit"],
            // ["guard_name" => "web",  "name" => "customers.delete"],

            // ["guard_name" => "web",  "name" => "sales.index"],
            // ["guard_name" => "web",  "name" => "sales.show"],
        );

        $stocker = Role::create(["guard_name" => "web", "name" => "Stocker"]);
        $stocker->givePermissionTo(
            Permission::whereIn("name", [
                "dashboard",
                "dashboard.best_selling_products",
                "dashboard.product_stocks",

                "products.index",
                "products.create",
                "products.edit",
                "products.delete",
            ])->get()

            // ["guard_name" => "web",  "name" => "dashboard"],
            // ["guard_name" => "web",  "name" => "dashboard.best_selling_products"],
            // ["guard_name" => "web",  "name" => "dashboard.product_stocks"],

            // ["guard_name" => "web",  "name" => "products.index"],
            // ["guard_name" => "web",  "name" => "products.create"],
            // ["guard_name" => "web",  "name" => "products.edit"],
            // ["guard_name" => "web",  "name" => "products.delete"],
        );
    }
}
