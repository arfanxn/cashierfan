<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Statistic extends MorphPivot
{
    protected $table = "statistics";
    private $name = "statisticable";

    protected $fillable = [
        "statisticable_type",
        "statisticable_id",
        "statisticable_key",
        "value",
    ];

    public static function write(
        string $able_type,
        int|null  $able_id = null,
        string $able_key,
        float $value,
        bool $decrementByValue = false
    ) {
        $statistic = static::query()->where(function ($query) use ($able_type, $able_id, $able_key) {
            if (is_numeric($able_id))
                $query->where("statisticable_id", $able_id);

            return $query->where("statisticable_key", $able_key)->where("statisticable_type", $able_type);
        })->first();

        if (is_null($statistic)) {
            $statistic = new static;
            $statistic->created_at = now();
        }

        $statistic->statisticable_type  = $able_type;
        $statistic->statisticable_id =  $able_id;
        $statistic->statisticable_key = $able_key;
        $statistic->updated_at = now();

        if (!$decrementByValue)
            $statistic->value = $statistic->value + $value;
        else if ($decrementByValue)
            $statistic->value = $statistic->value - $value;

        $statistic->save();

        return $statistic;
    }
}
