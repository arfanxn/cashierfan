<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductSale extends Pivot
{
    use HasFactory;

    const UPDATED_AT = null, CREATED_AT = null;

    protected $fillable = [
        "sale_id",
        "product_id",
        "tax_percentage",
        "tax",
        "profit_percentage",
        "profit",
        "quantity",
        'gross_price',
        'net_price',
        "sum_tax",
        'sum_profit',
        'sum_gross_price',
        'sum_net_price',
    ];
}
