<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\StatisticRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware("role_has_permission:dashboard");
    }

    public function __invoke(Request $request)
    {
        $products = Product::query()->select(["id", "barcode", "name", "image", 'stock'])
            ->orderBy("stock", "ASC")->orderBy("id", "ASC")->limit(10)->get();

        $statistics = [
            "products" => [
                'best_sellings' => StatisticRepository::bestSellingProducts()->limit(5)->get()
            ],
            "sales" => StatisticRepository::salesDateBetween(
                today()->subDays(7)->startOfDay(),
                today()->endOfDay()
            )->get()->groupBy(["date"])->map(function ($date) {
                return $date->groupBy("statisticable_key");
            })->map(function ($keyAsDate) {
                return $keyAsDate->map(fn($key) => $key[0]);
            })->toArray(),
        ];

        $statistics['sale'] = [
            "total_happen_today" => StatisticRepository::countSalesHappenToday(),
            "grosses_today" =>
            $statistics['sales'][today()->toDateString()]['sales_grosses']['value'] ?? 0,
            "profits_today" =>
            $statistics['sales'][today()->toDateString()]['sales_profits']['value'] ?? 0,
            "taxes_today" =>
            $statistics['sales'][today()->toDateString()]['sales_taxes']['value'] ?? 0,
            "netts_today" =>
            floatval($statistics['sales'][today()->toDateString()]['sales_grosses']['value'] ?? 0)
                +  floatval($statistics['sales'][today()->toDateString()]['sales_profits']['value'] ?? 0)
                +  floatval($statistics['sales'][today()->toDateString()]['sales_taxes']['value'] ?? 0),
        ];

        return Inertia::render("Dashboard", compact("statistics", 'products'));
    }
}
