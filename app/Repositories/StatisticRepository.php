<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Statistic;
use Carbon\Carbon;

class StatisticRepository extends Statistic
{
    public static function write(
        array $stat,
        string $valueOperator = "+"
    ) {
        $statistic = static::query()->where(function ($query) use ($stat) {
            if (is_numeric($stat['id'] ?? null))
                $query->where("statisticable_id", $stat['id']);

            if (isset($stat['date']))
                $query->where("date", $stat['date']);

            return $query->where("statisticable_key", $stat['key'])->where("statisticable_type", $stat['type']);
        })->first();

        if (is_null($statistic)) {
            $statistic = new static;
            $statistic->created_at = now();
        }

        $statistic->statisticable_type  = $stat['type'];
        $statistic->statisticable_id =  $stat['id'] ?? null;
        $statistic->statisticable_key = $stat['key'];
        $statistic->date = $stat['date'] ?? null;
        $statistic->time = $stat['time'] ?? null;
        $statistic->updated_at = now();

        switch ($valueOperator) {
            case '-':
                $statistic->value = $statistic->value - $stat['value'];
                break;
            case '=':
                $statistic->value = $stat['value'];
                break;
            default: // if operator was "+" or not valid add the value by current value 
                $statistic->value = $statistic->value + $stat['value'];
                break;
        }

        $statistic->save();

        return $statistic;
    }




    public static function bestSellingProducts()
    {
        return static::query()
            ->join(
                "products",
                fn ($join) => $join->on("statistics.statisticable_id", "=", "products.id")
                    ->where("statistics.statisticable_type", "=", Product::class)
            )->where("statisticable_key", "best_selling_products")
            ->select([
                "products.id AS product_id",
                "products.name AS product_name",
                "products.barcode AS product_barcode",
                "statistics.*"
            ])
            ->orderBy("value", "DESC");
    }

    public static function salesDateBetween(Carbon $startDate, Carbon $endDate)
    {
        return static::query()->where(function ($query)  use ($startDate, $endDate) {
            $conditions = ["sales_grosses", "sales_taxes", "sales_profits"];
            return $query->whereIn("statisticable_key", $conditions)
                ->whereBetween("date", [$startDate, $endDate]);
        })->orderBy("date", "ASC");
    }

    public static function countSalesHappenToday()
    {
        return static::query()
            ->where(fn ($q) =>
            $q->where("statisticable_key", "sales_happening_count")
                ->where("date", today()->startOfDay()))->first(['value'])['value'] ?? 0;
    }
}
