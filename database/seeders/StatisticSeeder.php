<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Statistic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatisticSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sales = Sale::query()->where("created_at", ">=", now()->subDays(7))->orderBy("created_at", "ASC")->get();

        Statistic::factory()->count(1)->create([
            "statisticable_type" => Sale::class,
            "statisticable_id" => $sale->id,
            "key" => "sales_profits_per_day",
            ""
        ]);
    }
}
