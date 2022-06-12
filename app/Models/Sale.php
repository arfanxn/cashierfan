<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'invoice',
        'cashier_id',
        'customer_id',
        'customer_pay_money',
        'customer_change_money',
        "discount",
        'sum_tax',
        'sum_profit',
        'sum_gross_price',
        'sum_net_price',
        "created_at",
    ];
}
