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
        'total_gross_price',
        'total_net_price',
        'total_discount',
        'total_profit',
        'tax',
        "created_at",
    ];
}
