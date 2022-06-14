<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "barcode",
        "name",
        "description",
        "image",
        "tax_percentage",
        "tax",
        "profit_percentage",
        "profit",
        "gross_price",
        "net_price",
        "stock",
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class);
    }
}
